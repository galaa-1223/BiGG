const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");

mix.js("resources/js/app.js", "public/dist/js")
    .sass("resources/sass/app.scss", "public/dist/css")
    .options({
        processCssUrls: false,
        postCss: [tailwindcss("./tailwind.config.js")],
    })
    .autoload({
        "cash-dom": ["$"],
    })
    .copyDirectory("resources/fonts", "public/dist/fonts")
    .copyDirectory("resources/images", "public/dist/images")
    .browserSync({
        proxy: "midone-laravel.test",
        files: ["resources/**/*.*"],
    });
