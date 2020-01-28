<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Mild\Http\ServerRequest;
use Mild\Support\Facades\Encryption;
use Mild\Support\Facades\Mail;
use Mild\Contract\Database\Exceptions\CompilerExceptionInterface;
use Mild\Support\Str;

class AuthController
{
    /**
     * @param ServerRequest $request
     * @return mixed
     * @throws CompilerExceptionInterface
     */
    public function login(ServerRequest $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        if (\Mild\Support\Facades\Hashing::check($request->getParsedBodyParam('password'), ($user = User::where('email', '=', $request->getParsedBodyParam('email'))->first())->password)) {
            return tap(response()->redirect(url()->getUri()), function () use ($user) {
                session('user_id', $user->id);
            });
        }

        return tap(response()->redirect($request->getServerParam('HTTP_REFERER')), function () use ($request) {
            flash()->set('__old', $request->getParsedBody());
            flash()->set('__errors.validation.password', trans('auth.login.failed.password'));
        });
    }

    /**
     * @param ServerRequest $request
     * @return mixed
     * @throws CompilerExceptionInterface
     */
    public function reset(ServerRequest $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $user = User::where('email', '=', $request->getParsedBodyParam('email'))->first();

        $now = Carbon::now();
        $password = PasswordReset::orderBy('id', 'desc')->first();

        if (!$password || $now->getTimestamp() > $password->expired_at->getTimestamp()) {
            $password = PasswordReset::create([
                'user_id'       => $user->id,
                'token'         => Encryption::encrypt(Str::random(16)),
                'expired_at'    => $now->addDay()
            ]);
        }

        Mail::send(function ($message) use ($user, $password) {
            $message->to('ilhampasya920@gmail.com')
                ->subject(trans('auth.forgot.title'))
                ->from('noreply@mildphp.online', app()->getName())
                ->body(view('vendor.mail.auth.reset_request', ['email' => $user->email, 'token' => $password->token]));
        });

        return response()->redirect($request->getServerParam('HTTP_REFERER'));
    }

    /**
     * @param ServerRequest $request
     * @return \Mild\View\Engine
     */
    public function resetPassword(ServerRequest $request)
    {
        return view('welcome');
    }

    /**
     * @param ServerRequest $request
     * @return mixed
     */
    public function logout(ServerRequest $request)
    {
        return tap(response()->redirect($request->getServerParam('HTTP_REFERER')), function () {
            session()->put('user_id');
        });
    }
}