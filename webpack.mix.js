const {resolve, basename, dirname} = require('path');

const mix = require('laravel-mix');
const webpack = require('webpack');
const glob = require('glob');
const del = require('del');
const WebpackNotifierPlugin = require('webpack-notifier');
const CopyPlugin = require('copy-webpack-plugin');
const distPath = resolve(__dirname, 'dist/theme');
const distPluginsPath = resolve(__dirname,'dist/plugin');
const srcPath = resolve(__dirname, 'src');

/*
-------------------------------------------------------------------------------
Helpers
-------------------------------------------------------------------------------
*/
const src = (file = '') => {
    return `${srcPath}/${file}`;
}

const dist = (file = '') => {
    return `${distPath}/${file}`;
}

const distPlugin = (file = '') => {
    return `${distPluginsPath}/${file}`;
}


/*
-------------------------------------------------------------------------------
Config
-------------------------------------------------------------------------------
*/

// Overriding default mix notifier
// Will use the "WebpackNotifierPlugin" instead, for more control.
mix.disableNotifications();

/*
-------------------------------------------------------------------------------
Browser sync
-------------------------------------------------------------------------------
*/
mix.browserSync({
    proxy: 'localhost:8000/',
    open: false,
    injectChanges: true,
    files: [`${distPath}/**/*.*`],
    ignore: [`${distPath}/vendor`],
    notify: false
});

/*
-------------------------------------------------------------------------------
Clean and build
-------------------------------------------------------------------------------
*/
const deleted = (async () => {
    return del.sync([dist('*')]);
})();

if (deleted) {

    /*
    -------------------------------------------------------------------------------
    Process JS & CSS
    -------------------------------------------------------------------------------
    */
    const projectJsFiles = glob.sync(src('theme/assets/js/main/index.js'));

    projectJsFiles.forEach((file) => {
        const fileName = basename(dirname(file));
        mix.js(file, dist(`assets/js/${fileName}.js`));
    })


    const projectScssFiles = glob.sync(src('theme/assets/css/**/index.less'));

    projectScssFiles.forEach((file) => {
        const fileName = basename(dirname(file)); 
        mix.less(file, dist(`assets/css/${fileName}.css`), {
            lessOptions: {
                strictMath: true
            }
        });
    })

    const projectLessFilesElementor = glob.sync(src('plugin/elementor/widgets/**/index.less'));

    projectLessFilesElementor.forEach((file) => {
        const fileName = basename(dirname(file)); 
        mix.less(file, distPlugin(`elementor/widgets/${fileName}/${fileName}.css`), {
            lessOptions: {
                strictMath: true
            }
        });
    })

    /*
    -------------------------------------------------------------------------------
    Override default webpack configuration
    -------------------------------------------------------------------------------
    */

    mix.webpackConfig({
        resolve: {
            alias: {
                'src': resolve(__dirname, '/src')
            }
        },
        plugins: [
            new WebpackNotifierPlugin({alwaysNotify: true}),
            new CopyPlugin(
                [
                    // Plugin rules
                    // ----------------------------------------------------------------------------
                    {
                        from: src('plugin/**/**.*'),
                        to: distPlugin(),
                        context: src('plugin'),
                        ignore: ['elementor/widgets/*/*.less'],
                    },
                    {
                        from: src('theme/**/**.*'),
                        to: dist(),
                        context: src('theme'),
                        ignore: ['assets/css/main/*','assets/css/custom/*','assets/js/main/*'],
                    },
                ],
                {
                    logLevel: 'warn',
                    copyUnmodified: false
                }
            ),
            new webpack.ProvidePlugin({
                React: 'react',
                Component: ['react', 'Component']
            }),
        ]
    });
}

