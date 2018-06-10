var gulp = require("gulp");
var sass = require("gulp-sass");
var autoprefixer = require("gulp-autoprefixer");
// var frontnote = require("gulp-frontnote");
var uglify = require("gulp-uglify");
var plumber = require("gulp-plumber");

gulp.task("sass", function () {
  gulp.src("wp-content/themes/15zine/library/sass/**/*scss")
      .pipe(plumber())
      .pipe(sass())
      .pipe(autoprefixer())
      .pipe(gulp.dest("wp-content/themes/15zine/library/css"));
});

gulp.task("js", function () {
  gulp.src(["wp-content/themes/15zine/library/js/**/*.js", "!wp-content/themes/15zine/library/js/min/**/*.js"])
      .pipe(plumber())
      .pipe(uglify())
      .pipe(gulp.dest("wp-content/themes/15zine/library/js/min"));
});

gulp.task("default", function () {
  gulp.watch('./wp-content/themes/15zine/library/sass/**/*.scss', ['sass']);
});
