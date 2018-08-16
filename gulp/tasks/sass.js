var changed = require('gulp-changed');

var autoprefixerOptions = {
    grid: false
}
var cssnanoOptions = {
    discardUnused: false,
    grid: false,
    zindex: false
    //reduceIdents: false,
    //mergeIdents: false,
    //mergeRules: false
}

module.exports = function (gulp, plugins, output) {
    return function () {
        gulp.src('src/scss/theme.scss')
            .pipe(changed(output))
            .pipe(plugins.sass())
            .pipe(plugins.autoprefixer(autoprefixerOptions))
            .pipe(plugins.cssnano(cssnanoOptions))
            .pipe(gulp.dest(output))
            .pipe(plugins.gzip())
            .pipe(gulp.dest(output));

        gulp.src('src/scss/login.scss')
            .pipe(changed(output))
            .pipe(plugins.sass())
            .pipe(plugins.autoprefixer(autoprefixerOptions))
            .pipe(plugins.cssnano(cssnanoOptions))
            .pipe(gulp.dest(output))
            .pipe(plugins.gzip())
            .pipe(gulp.dest(output));

        gulp.src('src/scss/login-bmc.scss')
            .pipe(changed(output))
            .pipe(plugins.sass())
            .pipe(plugins.autoprefixer(autoprefixerOptions))
            .pipe(plugins.cssnano(cssnanoOptions))
            .pipe(gulp.dest(output))
            .pipe(plugins.gzip())
            .pipe(gulp.dest(output));

    };

};