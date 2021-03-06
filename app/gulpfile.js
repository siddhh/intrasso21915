// On inclut les dépendances
const gulp = require('gulp');
const sass = require('gulp-sass');
const concatCss = require('gulp-concat-css');
const minifyCss = require('gulp-minify-css');

// Tâche "build-css-bootstrap" :
// On compile, concaténe et minifie notre propre version de bootstrap v4.5.0
gulp.task('build-css-bootstrap', () => {
    return gulp.src([
            'assets/scss/bootstrap/**/*.scss'
        ])
        .pipe(sass().on('error', sass.logError))
        .pipe(concatCss('bootstrap.min.css'))
        .pipe(minifyCss())
        .pipe(gulp.dest('./public/assets/css/'));
});

// Tâche "build-css-intrasso" :
// On compile, concaténe et minifie les styles de intrasso
gulp.task('build-css-intrasso', () => {
    return gulp.src([
            'assets/scss/intrasso/**/*.scss'
        ])
        .pipe(sass().on('error', sass.logError))
        .pipe(concatCss('app.min.css'))
        .pipe(minifyCss())
        .pipe(gulp.dest('./public/assets/css/'));
});

// Tâche "watch"
// Permet de vérifier les changements apportés aux différents fichiers, et de recompiler le style ou les scripts js
gulp.task('watch', function(){
    gulp.watch('assets/scss/intrasso/**/*.scss', gulp.series('build-css-intrasso'));
    gulp.watch('assets/scss/bootstrap/**/*.scss', gulp.series('build-css-bootstrap'));
});

// Tâche par défaut
// On effectue la tâche styles
gulp.task('default', gulp.series(['build-css-bootstrap', 'build-css-intrasso']));
