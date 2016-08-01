// Change these for each project as needed
var themeName = 'blank';
var rootPath = 'all_sites/dev/wp-content/themes/blank';
var credentials = {
    host: 'ftp.kylenumann.com',
    user: 'admin@kylenumann.com',
    pass: 'admin2770',
    port: 2222,
    remotePath: rootPath
};



// If all files are kept in their original folders,
// nothing below this line should need to be changed
var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var cleanCSS = require('gulp-clean-css');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var imagemin = require('gulp-imagemin');
var cache = require('gulp-cached');
var plumber = require('gulp-plumber');
var notify = require('gulp-notify');
var streamify = require('gulp-streamify');
var sftp = require('gulp-sftp');
var ftp = require('gulp-ftp');
var googleWebFonts = require('gulp-google-webfonts');
var svgsprite = require('gulp-svg-sprite');
var plumberErrorHandler = {
  errorHandler: notify.onError({
    title: 'Gulp',
    message: 'Error: <%= error.message %>'
  })
};

gulp.task('php', function () {

  credentials.remotePath = rootPath+'/templates';
  gulp.src(themeName+'/templates/*.php')
    .pipe(cache('php'))
    .pipe(plumber(plumberErrorHandler))
    .pipe(gulp.dest(themeName+'/templates/'))
    // .pipe(sftp(credentials));

});

gulp.task('sass', function () {

  credentials.remotePath = rootPath;
  gulp.src(themeName+'/sass/style.scss')
    .pipe(plumber(plumberErrorHandler))
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(sourcemaps.write('sass/'))
    // .pipe(cleanCSS({compatibility: 'ie8'}))
    .pipe(gulp.dest(themeName))
    // .pipe(ftp(credentials));

});

gulp.task('js', function () {

  credentials.remotePath = rootPath+'/js';
  gulp.src(themeName+'/js/scripts/*.js')
    .pipe(plumber(plumberErrorHandler))
    .pipe(jshint())
    .pipe(jshint.reporter('fail'))
    .pipe(concat('scripts.js'))
    // .pipe(uglify())
    .pipe(gulp.dest(themeName+'/js'))
    // .pipe(sftp(credentials));

});

gulp.task('img', function() {

  credentials.remotePath = rootPath+'/img';
  gulp.src(themeName+'/img/original/*.{png,jpg,gif}')
    .pipe(cache('img'))
    .pipe(plumber(plumberErrorHandler))
    .pipe(imagemin({
      optimizationLevel: 7,
      progressive: true
    }))
    .pipe(gulp.dest(themeName+'/img'));
    // .pipe(sftp(credentials));

});

gulp.task('svg', function() {

  // Basic configuration example
  config                  = {
      mode                : {
          symbol            : {
            inline          : true
          },
          // css             : {
          //     render      : {
          //         css     : true
          //     }
          // }
      }
  };

  credentials.remotePath = rootPath+'/img/svg';
  gulp.src(themeName+'/img/svg/*.svg')
    .pipe(svgsprite(config))
    .pipe(gulp.dest(themeName+'/img/svg'));
    // .pipe(sftp(credentials));

});

gulp.task('fonts', function () {

  credentials.remotePath = rootPath+'/fonts';
  gulp.src(themeName+'/fonts.list')
    .pipe(googleWebFonts())
    .pipe(gulp.dest(themeName+'/fonts'));
    // .pipe(streamify(sftp(credentials)));

});

gulp.task('watch', function() {

  gulp.watch(themeName+'/templates/*.php', ['php']);
  gulp.watch([themeName+'/sass/*/*.scss', themeName+'/sass/*.scss'], ['sass']);
  gulp.watch(themeName+'/js/*/*.js', ['js']);
  gulp.watch(themeName+'/img/*/*.{png,jpg,gif}', ['img']);

});

gulp.task('default', ['php', 'sass', 'js', 'img']);
