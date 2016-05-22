var gulp = require('gulp')
var gutil = require('gutil')
var plugins = require('gulp-load-plugins')()

gulp.task('default', ['watch'])

gulp.task('watch', function () {
  gulp.watch('styles/*.less', ['compile-css'])
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
