let mix = require('laravel-mix');
let execSync = require('child_process').execSync;

mix.js(`${__dirname}/resources/assets/admin/js/main.js`, `${__dirname}/assets/admin/js/storefront.js`)
    .js(`${__dirname}/resources/assets/public/js/app.js`, `${__dirname}/assets/public/js/app.js`)
    .js(`${__dirname}/resources/assets/public/js/vendors/flatpickr.js`, `${__dirname}/assets/public/js/flatpickr.js`)
    .sass(`${__dirname}/resources/assets/admin/sass/main.scss`, `${__dirname}/assets/admin/css/storefront.css`)
    .sass(`${__dirname}/resources/assets/public/sass/app.scss`, `${__dirname}/assets/public/css/app.css`)
    .copy(`${__dirname}/node_modules/line-awesome/dist/line-awesome/fonts`, `${__dirname}/assets/public/fonts`)
    .copy(`${__dirname}/node_modules/slick-carousel/slick/fonts`, `${__dirname}/assets/public/css/fonts`)
    .copy(`${__dirname}/node_modules/slick-carousel/slick/ajax-loader.gif`, `${__dirname}/assets/public/css`)
    .copy(`${__dirname}/resources/assets/public/images`, `${__dirname}/assets/public/images`)
    .then(() => {
        execSync(`npm run rtlcss ${__dirname}/assets/admin/css/storefront.css ${__dirname}/assets/admin/css/storefront.rtl.css`);
        execSync(`npm run rtlcss ${__dirname}/assets/public/css/app.css ${__dirname}/assets/public/css/app.rtl.css`);
    });
