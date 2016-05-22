var gulp = require('gulp')
var plugins = require('gulp-load-plugins')()
var gutil = require('gutil')
var del = require('del')
var ftp = require('vinyl-ftp')
var config = require('./config')
var _ = require('lodash')

gulp.task('default', ['watch'])

gulp.task('watch', ['compile-css'], function () {
  gulp.watch('styles/*.less', ['compile-css'])
})

gulp.task('clean', function () {
  return del(['build'])
})

gulp.task('compile-css', function () {
  return gulp.src('styles/*.less')
    .pipe(plugins.plumber())
    .pipe(plugins.less())
    .on('error', function (err) {
      gutil.log(err)
      this.emit('end')
    })
    .pipe(plugins.cssmin())
    .pipe(gulp.dest('public/css')).on('error', gutil.log)
})

gulp.task('deploy', ['compile-css', 'clean'], function () {
  var filesToOmit = [
    '!public/shows.json',
    '!public/php/db-config.php'
  ]

  var ftpUpload = ftp.create(_.merge(config.server_ftp, {
    log: gutil.log
  }))

  return gulp.src(['public/**/*'].concat(filesToOmit))
    .pipe(gulp.dest('build'))
    .pipe(ftpUpload.newer(config.server_folder))
    .pipe(ftpUpload.dest(config.server_folder))
})
