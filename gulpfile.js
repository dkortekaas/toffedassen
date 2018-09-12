var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();

// output dir
var outputAssets = './assets';

// Gulp Tasks
var gulpTasks = './gulp/tasks';

//gulp.task('scripts', require(gulpTasks + '/scripts')(gulp, plugins, outputAssets + '/scripts'));
gulp.task('sass', require(gulpTasks + '/sass')(gulp, plugins, outputAssets + '/css'));
gulp.task('imagemin', require(gulpTasks + '/imagemin')(gulp, plugins, outputAssets + '/images'));
gulp.task('svg', require(gulpTasks + '/svg')(gulp, plugins, outputAssets + '/svg'));
gulp.task('fonts', require(gulpTasks + '/fonts')(gulp, plugins, outputAssets + '/fonts'));

gulp.task('watch', ['sass'], function () {
    gulp.watch('src/scss/**/*.scss', ['sass']);
    //gulp.watch('src/js/**/*.js', ['scripts']);
});

gulp.task('default', ['sass', 'imagemin', 'fonts', 'svg'], function () { });