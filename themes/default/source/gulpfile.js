import pkg from 'gulp';

const { gulp, src, dest, parallel, series, watch } = pkg;

import uglify      from 'gulp-uglify';
import cssnano     from 'gulp-cssnano';
import concat      from 'gulp-concat';
import gulpPug      from 'gulp-pug';
import gulpSass    from 'gulp-sass';
import dartSass    from 'sass';
const  sass        = gulpSass(dartSass);

function styles() {
	return src('sass/**/main.scss')
		.pipe(eval(sass()))
		.pipe(concat('style.min.css'))
		.pipe(cssnano())
		.pipe(dest('../web/css'));
}

function scripts() {
    return src(['js/main.js'])
    .pipe(concat('main.min.js'))
    .pipe(uglify())
    .pipe(dest('../web/js'))
}

function startwatch() {
    watch('sass/**/*.scss', styles);
	watch('js/*.js', scripts);
	watch('pug/**/*.pug', html);
}

function html() {
	return src('pug/pages/*.pug')
		.pipe(gulpPug({
			pretty: true
		}))
		.pipe(dest('../web'))
}

export { scripts, styles, html };

export default series(scripts, styles, html, parallel(startwatch));
