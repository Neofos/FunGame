var gulp = require('gulp');
var less = require('gulp-less');

gulp.task('less', function(cb) {
  var srcfile = '*.less';
  var destdir = './assets/css';

  gulp
    .src(srcfile)
    .pipe(less())
    .pipe(
      gulp.dest(destdir)
    );
  cb();
});

gulp.task(
  'default',
  gulp.series('less', function(cb) {
    gulp.watch('*.less', gulp.series('less'));
    cb();
  })
);