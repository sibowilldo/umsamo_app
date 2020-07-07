
const mix = require('laravel-mix');
// version does not work in hmr mode
if (process.env.npm_lifecycle_event !== 'hot') {
    mix.version();
}

const glob = require('glob');
const path = require('path');
const ReplaceInFileWebpackPlugin = require('replace-in-file-webpack-plugin');
const rimraf = require('rimraf');

// fix css files 404 issue
mix.webpackConfig({
    devServer: {
        contentBase: path.resolve(__dirname, 'public'),
    }
});
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// Default
mix.js('resources/js/app.js', 'public/js')
    .scripts('resources/js/config.js', 'public/js/config.js')
    .sass('resources/sass/app.scss', 'public/css');

// Project Specific

mix.scripts('resources/metronic/plugins/formvalidation/dist/js/plugins/Tachyons.js', 'public/plugins/custom/formvalidation/plugins/Tachyons.js')
    .scripts('resources/metronic/plugins/formvalidation/dist/js/plugins/PasswordStrength.js', 'public/plugins/custom/formvalidation/plugins/PasswordStrength.js')
    .scripts('resources/metronic/plugins/formvalidation/dist/js/plugins/Transformer.js', 'public/plugins/custom/formvalidation/plugins/Transformer.js');

mix.copy('resources/system/fonts/blowbrush.ttf', 'public/system/fonts')
    .copyDirectory('resources/system/images', 'public/system/images')
    .copyDirectory('resources/system/favicons', 'public/system/favicons');

mix.scripts(['resources/metronic/js/vendors/plugins/sweetalert2.init.js'], 'public/js/init-plugins.js');

// Metronic js pages (single page use)
(glob.sync('resources/js/pages/**/**/*.js') || []).forEach(file => {
    mix.js(file, `public/${file.replace('resources/', '')}`);
});


// Metronic js pages (single page use)
(glob.sync('resources/js/plugins/**/*.js') || []).forEach(file => {
    mix.js(file, `public/${file.replace('resources/', '')}`);
});


// Global jquery
// mix.autoload({
    // 'jquery': ['$', 'jQuery'],
    // Popper: ['popper.js', 'default'],
// });

// 3rd party plugins css/js
mix.sass('resources/plugins/plugins.scss', 'public/plugins/global/plugins.bundle.css').then(() => {
    // remove unused preprocessed fonts folder
    rimraf(path.resolve('public/fonts'), () => {});
    rimraf(path.resolve('public/images'), () => {});
})
    // .setResourceRoot('./')
    .options({processCssUrls: false})
    .js(['resources/plugins/plugins.js'], 'public/plugins/global/plugins.bundle.js');

// Metronic css/js
mix.sass('resources/metronic/sass/style.scss', 'public/css/style.bundle.css', {
    sassOptions: {includePaths: ['node_modules']},
})
    // .options({processCssUrls: false})
    .js('resources/js/scripts.js', 'public/js/scripts.bundle.js');

// Custom 3rd party plugins
(glob.sync('resources/plugins/custom/**/*.js') || []).forEach(file => {
    mix.js(file, `public/${file.replace('resources/', '').replace('.js', '.bundle.js')}`);
});
(glob.sync('resources/plugins/custom/**/*.scss') || []).forEach(file => {
    mix.sass(file, `public/${file.replace('resources/', '').replace('.scss', '.bundle.css')}`)
});

// Metronic css pages (single page use)
(glob.sync('resources/metronic/sass/pages/**/!(_)*.scss') || []).forEach(file => {
    file = file.replace(/[\\\/]+/g, '/');
    mix.sass(file, file.replace('resources/metronic/sass', 'public/css').replace(/\.scss$/, '.css'));
});

// Metronic js pages (single page use)
(glob.sync('resources/metronic/js/pages/**/*.js') || []).forEach(file => {
    mix.js(file, `public/${file.replace('resources/metronic/', '')}`);
});

// Metronic media
mix.copyDirectory('resources/metronic/media', 'public/media');

// Metronic theme
(glob.sync('resources/metronic/sass/themes/**/!(_)*.scss') || []).forEach(file => {
    file = file.replace(/[\\\/]+/g, '/');
    mix.sass(file, file.replace('resources/metronic/sass', 'public/css').replace(/\.scss$/, '.css'));
});

mix.webpackConfig({
    mode: "none",
    plugins: [
        new ReplaceInFileWebpackPlugin([
            {
                // rewrite font paths
                dir: path.resolve('public/plugins/global'),
                test: /\.css$/,
                rules: [
                    {
                        // fontawesome
                        search: /\.\.\/webfonts\/(fa-)/ig,
                        replace: './fonts/@fortawesome/$1'
                    },
                    {
                        // flaticon
                        search: /\.\/font\/(Flaticon\.)/ig,
                        replace: './fonts/flaticon/$1',
                    },
                    {
                        // flaticon2
                        search: /\.\/font\/(Flaticon2\.)/ig,
                        replace: './fonts/flaticon2/$1',
                    },
                    {
                        // keenthemes fonts
                        search: /\.\/(Ki\.)/ig,
                        replace: './fonts/keenthemes-icons/$1'
                    },
                ],
            },
        ]),
    ],
});

// Webpack.mix does not copy fonts, manually copy
(glob.sync('resources/metronic/plugins/**/*.+(woff|woff2|eot|ttf)') || []).forEach(file => {
    var folder = file.match(/resources\/metronic\/plugins\/(.*?)\//)[1];
    mix.copy(file, `public/plugins/global/fonts/${folder}/${path.basename(file)}`);
});
(glob.sync('node_modules/+(@fortawesome|socicon)/**/*.+(woff|woff2|eot|ttf)') || []).forEach(file => {
    var folder = file.match(/node_modules\/(.*?)\//)[1];
    mix.copy(file, `public/plugins/global/fonts/${folder}/${path.basename(file)}`);
});

(glob.sync('node_modules/+(line-awesome)/**/*.+(woff|woff2|eot|ttf)') || []).forEach(file => {
    mix.copy(file, `public/plugins/fonts/${path.basename(file)}`);
});
