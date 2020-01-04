var gulp = require('gulp');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var browserify = require('browserify');
var babelify= require('babelify');
var source = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');
var uglify = require('gulp-uglify');
var notify       = require( 'gulp-notify' );
var browserSync = require('browser-sync').create();
//var plumber = require('gulp-plumber');
var reload = browserSync.reload;

//var projectURL   = 'http://localhost/custom-plugin/';


// Project related variables
var styleSRC     = './src/scss/mystyle.scss';
var styleFrom   = './src/scss/form.scss';
var styleSlider   = './src/scss/slider.scss';
var styleAuth    = './src/scss/auth.scss';
var styleURL     = './assets/';

var mapURL       = './';

var jsSRC        = './src/js/';
var jsURL        = './assets/';
var jsAdmin 	 = 'myscript.js';
var jsfrom	     = 'form.js';
var jsSlider	 = 'slider.js';
var jsAuth	     = 'auth.js';

var styleWatch   = './src/scss/**/*.scss';
var jsWatch      = './src/js/**/*.js';
var phpWatch     =  './**/*.php';

//var jsFiles = [jsAdmin, jsfrom, jsSlider, jsAuth];
var jsFiles = [jsAdmin];
    
// Tasks
function browser_sync() {
	browserSync.init({ 
        proxy   : "http://localhost/custom-plugin/",
        open: true,
        injectChanges: true
       //proxy: "Write URL Here and remove the server",
       //https:{
       //   key:  '',
       //   cert: ''
       // }   
    });
}

function reload(done) {
	browserSync.reload();
	done();
}

function css(done){
    //gulp.src( [styleSRC, styleFrom, styleSlider, styleAuth] )
	gulp.src( [styleSRC] )
	.pipe(sourcemaps.init())
	.pipe(sass({
		errorLogToConsole:true,
		outputStyle: 'compressed'
	}))
	.on( 'error', console.error.bind(console))
	.pipe(autoprefixer({
		//browsers: ['last 2 versions'],
		cascade: false
	}))
	.pipe(sourcemaps.write(mapURL))
	.pipe(gulp.dest( styleURL ))
	.pipe(browserSync.stream());
	done();
	
};

function js(done){
	jsFiles.map(function (entry) {
        browserify({
            entries: [jsSRC + entry]
        })
        .transform(babelify, {presets: ["@babel/preset-env"]})
        .bundle()
        .pipe(source(entry))
        .pipe( buffer())
        .pipe( sourcemaps.init({ loadMaps:true }))
        .pipe(uglify())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest( jsURL ))
        .pipe(browserSync.stream())
    
	});
    done();
};

// function triggerPlumber(src, url){
//     return gulp.src(src)
//     .pipe( plumber() )
//     .pipe( gulp.dest(url) );
// }

function watch_files(){
	gulp.watch(phpWatch, reload);
    gulp.watch(styleWatch, css);
	gulp.watch(jsWatch, js);
    gulp.src(jsURL + 'myscript.js')
    .pipe( notify({message: 'Gulp is watching, Happy coding!'}));
}

gulp.task("css", css);
gulp.task("js", js);
gulp.task("default", gulp.series(css, js));
gulp.task("watch", gulp.parallel(browser_sync, watch_files));