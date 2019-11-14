import gulp from 'gulp';
import folders from './folders';
import {reload} from './browserSync';

gulp.task('scripts', () =>
	gulp.src(`${folders.assetsSrc}/js/*.js`)
		.pipe(gulp.dest(`${folders.assetsBuild}/js`))
);

gulp.task('scripts:watch', () =>
	gulp.watch(`${folders.assetsSrc}/js/*.js`, gulp.series('scripts', reload))
);