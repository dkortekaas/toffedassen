// var changed = require('gulp-changed');
// var gulpif = require('gulp-if');

// module.exports = function (gulp, plugins, output, minify) {
//     return function () {

//         var shouldMinify = function () {
//             return minify !== false;
//         }

//         //Frameworks
//         gulp.src('src/js/frameworks/jquery.2.1.1.min.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('jquery.min.js'))
//             .pipe(plugins.uglify())
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/components/general/**/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('components.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }));

//         gulp.src('src/js/components/waiting-card/**/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('waiting-card.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }));

//         gulp.src('src/js/components/listpage/**/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('listpage.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/components/CanalTicket/**/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('canalticket.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/components/Tiqets/**/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('tiqets.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));        

//         gulp.src('src/js/components/TwentyFourHours/**/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('twentyFourHours.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/components/Routes/**/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('routes.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/components/Webshop/**/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('webshop.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/components/venuefinder/**/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('venuefinder.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/components/BusinessAgenda/**/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('businessagenda.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/plugins/**/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('plugins.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/legacy/components/**/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('legacy-components.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/initialize/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('initialize.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/legacy/plugins/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('legacy-plugins.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/legacy/180/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('180.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/legacy/business/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('legacy-business.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/legacy/citycard/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('legacy-citycard.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/polyfills/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('polyfills.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/legacy/specific/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('legacy-specific.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));

//         gulp.src('src/js/legacy/canaltickets/*.js')
//             .pipe(changed(output))
//             .pipe(plugins.concat('legacy-canaltickets.min.js'))
//             .pipe(gulpif(shouldMinify, plugins.uglify()))
//             .pipe(gulp.dest(output))
//             .pipe(plugins.gzip({ gzipOptions: { level: 5 } }))
//             .pipe(gulp.dest(output));
//     };
// };