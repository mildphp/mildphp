var src = './resources/assets/';
var dst = './public/assets/';
var gulp  = require('gulp');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var browserify = require('gulp-browserify');

gulp.task('sass', () => {
    return gulp.src(src+'sass/app.scss')
        .pipe(sass({
            outputStyle: 'compressed',
            includePaths: ['node_modules']
        }))
        .pipe(gulp.dest(dst+'css'))
});

gulp.task('js', () => {
    return gulp.src(src+'js/app.js', {allowEmpty: true})
        .pipe(browserify())
        .pipe(uglify())
        .pipe(gulp.dest(dst+'js'))
})

gulp.task('fonts', function() {
    return gulp.src('node_modules/font-awesome/fonts/*')
        .pipe(gulp.dest(dst+'fonts'))
})

gulp.task('default', gulp.series('js', 'sass', 'fonts'))
