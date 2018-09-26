var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('styles', function(){
  return gulp.src('styles2.scss')
    .pipe(sass())
    .pipe(gulp.dest('../web/css'))
});

gulp.task('js', function(){
  return gulp.src(['bower_components/jquery/dist/jquery.min.js', 'bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js'])
    .pipe(gulp.dest('../web/js'))
});

gulp.task('fonts', function(){
  return gulp.src('bower_components/bootstrap-sass/assets/fonts/*/**')
    .pipe(gulp.dest('../web/fonts'))
});

gulp.task('default', ['styles', 'js', 'fonts']);