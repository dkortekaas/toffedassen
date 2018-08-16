var pngquant = require('imagemin-pngquant');
var changed = require('gulp-changed');
var rename = require("gulp-rename");

module.exports = function (gulp, plugins, output) {
    return function () {
        gulp.src('src/images/svg/*')
            .pipe(changed(output))
            .pipe(plugins.imagemin({
                svgoPlugins: [{ removeViewBox: false }, { removeComments: true }, { js2svg: { pretty: true } }]
            }))
        .pipe(gulp.dest(output));
    };
};

