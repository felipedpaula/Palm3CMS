const gulp = require('gulp');
const terser = require('gulp-terser');
const gulpif = require('gulp-if');
const del = require('del');
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const unprefix = require("postcss-unprefix");
const autoprefixer = require('autoprefixer');
const postcss = require('gulp-postcss');
const cleanCSS = require('gulp-clean-css');
const changed = require('gulp-changed');
const imagemin = require('gulp-imagemin');

// Configs
let jsDebug = false;
let jsDev = false;
const babelConfig = {
    presets: ['@babel/env'],
    babelrc: false,
};

let cssDebug = false;
let cleanCSSOpts = {};
const processors = [
    unprefix,
    autoprefixer,
];
const packageConfigs = require('./package.json');
const { scriptsVer, stylesVer } = packageConfigs.palmConfigs;

const destinationFiles = [
    'public/assets/js/scripts.min.js',
];

const defaultJavascriptFiles = [
    'resources/assets/js/scripts.js',
];

const defaultCssFiles = [
    'resources/assets/css/styles.css',
];

//Script Tasks
gulp.task('defaultScripts', () =>
gulp.src(defaultJavascriptFiles)
    .pipe(gulpif(!jsDebug, babel(babelConfig)))
    .pipe(gulpif(!jsDebug && !jsDev, terser()))
    .pipe(concat(`all-${scriptsVer}.min.js`))
    .pipe(gulp.dest('public/assets/js'))
);

gulp.task('scripts', (done) =>
  gulp.parallel(['defaultScripts',])(done)
);

gulp.task('scripts:dev', (done) => {
  jsDev = true;
  return gulp.parallel(['defaultScripts',])(done);
});

gulp.task('scripts:debug', (done) => {
  jsDebug = true;
  return gulp.parallel(['defaultScripts',])(done);
});

gulp.task('scripts', (done) =>
gulp.parallel([
    'defaultScripts',
  ])(done)
);

gulp.task('scripts:dev', (done) => {
jsDev = true;
return gulp.parallel([
    'defaultScripts',

])(done);
});

gulp.task('scripts:debug', (done) => {
jsDebug = true;
return gulp.parallel([
    'defaultScripts',

])(done);
});

// CSS Tasks
gulp.task('defaultCSS', () =>
  gulp.src(defaultCssFiles)
    .pipe(gulpif(!cssDebug, postcss(processors)))
    .pipe(gulpif(!cssDebug, cleanCSS(cleanCSSOpts)))
    .pipe(concat(`all-${stylesVer}.min.css`))
    .pipe(gulp.dest('public/assets/css'))
);

gulp.task('css', (done) =>
  gulp.parallel(['defaultCSS',])(done)
);

gulp.task('css:dev', (done) => {
    cleanCSSOpts = { format: 'beautify', level: 2 };
    return gulp.parallel(['defaultCSS',])(done);
});

gulp.task('css:debug', (done) => {
    cssDebug = true;
    return gulp.parallel(['defaultCSS',])(done);
});

// Clean and watch
gulp.task('clean', () =>
    del(destinationFiles)
);

gulp.task('watch', function () {
    gulp.watch([
    ...defaultJavascriptFiles,
    ],
    gulp.series(['scripts:debug'])
    );
    gulp.watch([
    ...defaultCssFiles
    ],
    gulp.series(['css:debug'])
    );
});

// Commands
exports.default = gulp.series([
'clean',
    gulp.parallel([
    'scripts',
    'css'
    ])
]);
exports.dev = gulp.series([
'clean',
    gulp.parallel([
    'scripts:dev',
    'css:dev'
    ])
]);
exports.debug = gulp.series([
'clean',
    gulp.parallel([
    'scripts:debug',
    'css:debug'
    ])
]);
exports.watch = gulp.series(['watch']);
