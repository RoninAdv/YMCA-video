// Require
var gulp = require('gulp'),
	watch = require('gulp-watch'),
	cat  = require('gulp-cat'),
	sass = require('gulp-sass'),
	autoprefixer = require('gulp-autoprefixer'),
	jshint = require('gulp-jshint'),
	uglify = require('gulp-uglify'),
	concat = require('gulp-concat'),
	sourcemaps = require('gulp-sourcemaps'),
	livereload = require('gulp-livereload'),
	plumber = require('gulp-plumber'),
	gutil = require('gulp-util'),
	browserSync = require('browser-sync');

// BrowserSync
gulp.task('browser-sync', ['sass', 'js'], function() {
	browserSync.init({
		logPrefix: 'ronin.dev',
		open: 'external',
		host: '10.1.10.233:8888',
		proxy: '10.1.10.233:8888',
		reloadDelay: 3000,
        open: true
		//port: 8888,
	});
});

// Sass Compiling
gulp.task('sass', function(){
  return gulp.src('assets/scss/*.scss')
  .pipe(plumber(function (error) {
	    gutil.log(error.message);
	    this.emit('end');
	}))
  .pipe(sourcemaps.init())
	.pipe(sass({
		sourcemap: true,
		errLogToConsole: true,
		outputStyle: 'compressed',
		//outputStyle: 'nested',

		precision: 12
	}))
	.pipe(autoprefixer({
		browsers: ['last 10 versions'],
        cascade: false
	}))
    .pipe(sourcemaps.write('maps'))
	.pipe(gulp.dest('assets/css'))
	//.pipe(livereload())
	.pipe(browserSync.stream());

});




// JS Task(s)
gulp.task('js', function () {
   return gulp.src(['assets/js/libs/*.js','assets/js/*.js'])
   	  .pipe(plumber())
      .pipe(uglify())
      .pipe(concat('site.min.js'))
      .pipe(gulp.dest('assets/js/build'))
      //.pipe(livereload())
      .pipe(browserSync.stream());
});





// Watch
gulp.task( 'watch', function() {
	//livereload.listen();

	gulp.watch('assets/js/*.js', ['js']);
	gulp.watch('**/*.php').on('change', browserSync.reload);
	gulp.watch( 'assets/scss/**/*.scss', [ 'sass' ] );
});



// Default Task
gulp.task('default', ['browser-sync','watch'], function (){
	//livereload.listen();
	return gulp.src('./BOXPRESS.md')
        .pipe(cat());
});
