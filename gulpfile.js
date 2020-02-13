const gulp = require('gulp');
const sass = require('gulp-sass');
const del = require('del');
const concat = require('gulp-concat');
const gulpif = require('gulp-if');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const sourcemaps = require('gulp-sourcemaps');
const zip = require('gulp-zip');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');

let prod = process.env.NODE_ENV === 'production';

const paths = {
    build : {
        js : 'assets/js/',
        css : 'assets/css/',
    },
    src : {
        js : 'src/js/',
        scss : 'src/scss/',
    },
    watch: {
        js : 'src/js/**/*',
        scss : 'src/scss/**/*'
    },
    clean: [
        'assets/js/**/*',
        'assets/css/**/*',
    ],
};

const postCssPlugins = [
    autoprefixer(),
];

if (prod) {
    postCssPlugins.push(cssnano());
}

gulp.task('clean', function () {
    return del(paths.clean);
});

gulp.task('scss:address-component', function () {
    return gulp.src([
        paths.src.scss + 'address-component.scss',
    ])
        .pipe(gulpif(!prod, sourcemaps.init()))
        .pipe(sass({
            noCache: true,
            style: 'compressed',
            includePaths: [
                'node_modules',
            ]
        }))
        .pipe(postcss(postCssPlugins))
        .pipe(concat('address-component.min.css'))
        .pipe(gulpif(!prod, sourcemaps.write('.')))
        .pipe(gulp.dest(paths.build.css));
});

gulp.task('scss:contact-component', function () {
    return gulp.src([
        paths.src.scss + 'contact-component.scss',
    ])
        .pipe(gulpif(!prod, sourcemaps.init()))
        .pipe(sass({
            noCache: true,
            style: 'compressed',
            includePaths: [
                'node_modules',
            ]
        }))
        .pipe(postcss(postCssPlugins))
        .pipe(concat('contact-component.min.css'))
        .pipe(gulpif(!prod, sourcemaps.write('.')))
        .pipe(gulp.dest(paths.build.css));
});

gulp.task('scss:logo-component', function () {
    return gulp.src([
        paths.src.scss + 'logo-component.scss',
    ])
        .pipe(gulpif(!prod, sourcemaps.init()))
        .pipe(sass({
            noCache: true,
            style: 'compressed',
            includePaths: [
                'node_modules',
            ]
        }))
        .pipe(postcss(postCssPlugins))
        .pipe(concat('logo-component.min.css'))
        .pipe(gulpif(!prod, sourcemaps.write('.')))
        .pipe(gulp.dest(paths.build.css));
});

gulp.task('scss:opening-hours-component', function () {
    return gulp.src([
        paths.src.scss + 'opening-hours-component.scss',
    ])
        .pipe(gulpif(!prod, sourcemaps.init()))
        .pipe(sass({
            noCache: true,
            style: 'compressed',
            includePaths: [
                'node_modules',
            ]
        }))
        .pipe(postcss(postCssPlugins))
        .pipe(concat('opening-hours-component.min.css'))
        .pipe(gulpif(!prod, sourcemaps.write('.')))
        .pipe(gulp.dest(paths.build.css));
});

gulp.task('scss:socials-component', function () {
    return gulp.src([
        paths.src.scss + 'socials-component.scss',
    ])
        .pipe(gulpif(!prod, sourcemaps.init()))
        .pipe(sass({
            noCache: true,
            style: 'compressed',
            includePaths: [
                'node_modules',
            ]
        }))
        .pipe(postcss(postCssPlugins))
        .pipe(concat('socials-component.min.css'))
        .pipe(gulpif(!prod, sourcemaps.write('.')))
        .pipe(gulp.dest(paths.build.css));
});

const jsUglifyCondition = function(file) {
    if (!prod) {
        return false;
    }

    if (file.path.match(/node_modules/g)) {
        return false;
    }

    return true;
};

gulp.task('js:address-component', function () {
    return gulp.src([
        paths.src.js + 'address-component.js',
    ])
        .pipe(gulpif(!prod, sourcemaps.init()))
        .pipe(babel())
        .pipe(gulpif(jsUglifyCondition, uglify({mangle: false})))
        .pipe(concat('address-component.min.js'))
        .pipe(gulpif(!prod, sourcemaps.write('.')))
        .pipe(gulp.dest(paths.build.js));
});

gulp.task('js:contact-component', function () {
    return gulp.src([
        paths.src.js + 'contact-component.js',
    ])
        .pipe(gulpif(!prod, sourcemaps.init()))
        .pipe(babel())
        .pipe(gulpif(jsUglifyCondition, uglify({mangle: false})))
        .pipe(concat('contact-component.min.js'))
        .pipe(gulpif(!prod, sourcemaps.write('.')))
        .pipe(gulp.dest(paths.build.js));
});

gulp.task('js:logo-component', function () {
    return gulp.src([
        paths.src.js + 'logo-component.js',
    ])
        .pipe(gulpif(!prod, sourcemaps.init()))
        .pipe(babel())
        .pipe(gulpif(jsUglifyCondition, uglify({mangle: false})))
        .pipe(concat('logo-component.min.js'))
        .pipe(gulpif(!prod, sourcemaps.write('.')))
        .pipe(gulp.dest(paths.build.js));
});

gulp.task('js:opening-hours-component', function () {
    return gulp.src([
        paths.src.js + 'opening-hours-component.js',
    ])
        .pipe(gulpif(!prod, sourcemaps.init()))
        .pipe(babel())
        .pipe(gulpif(jsUglifyCondition, uglify({mangle: false})))
        .pipe(concat('opening-hours-component.min.js'))
        .pipe(gulpif(!prod, sourcemaps.write('.')))
        .pipe(gulp.dest(paths.build.js));
});

gulp.task('js:socials-component', function () {
    return gulp.src([
        paths.src.js + 'socials-component.js',
    ])
        .pipe(gulpif(!prod, sourcemaps.init()))
        .pipe(babel())
        .pipe(gulpif(jsUglifyCondition, uglify({mangle: false})))
        .pipe(concat('socials-component.min.js'))
        .pipe(gulpif(!prod, sourcemaps.write('.')))
        .pipe(gulp.dest(paths.build.js));
});

gulp.task('scss', gulp.parallel(
    'scss:address-component',
    'scss:contact-component',
    'scss:logo-component',
    'scss:opening-hours-component',
    'scss:socials-component'
));

gulp.task('js', gulp.parallel(
    'js:address-component',
    'js:contact-component',
    'js:logo-component',
    'js:opening-hours-component',
    'js:socials-component'
));

gulp.task('watch',  gulp.parallel(function () {
    gulp.watch(paths.watch.scss, gulp.parallel('scss'));
    gulp.watch(paths.watch.js, gulp.parallel('js'));
}));

gulp.task('zip', function () {
    return gulp.src([
        './assets/**/*',
        '!./assets/manifest/',
        '!./assets/manifest/**/*',
        './classes/**/*.php',
        './components/**/*',
        './controllers/**/*',
        './config/**/*.php',
        './lang/**/*.php',
        './models/**/*',
        './updates/**/*',
        './Plugin.php',
        './plugin.yaml',
    ], {base: '.'})
        .pipe(zip('popup.zip'))
        .pipe(gulp.dest('.'));
});

gulp.task('build', gulp.series('clean', gulp.parallel('scss', 'js'), 'zip'));

gulp.task('default', gulp.series('build'));
