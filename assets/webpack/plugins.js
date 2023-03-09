const webpack = require('webpack');
const path = require('path');
const argv = require('minimist')(process.argv.slice(2));
const autoprefixer = require('autoprefixer');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const WebpackCleanupPlugin = require('webpack-cleanup-plugin');
const FaviconsWebpackPlugin = require('favicons-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const imageminMozjpeg = require('imagemin-mozjpeg');
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
// const DashboardPlugin = require('webpack-dashboard/plugin');

const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

const pkg = require('../../package.json');

const isProduction = !!((argv.env && argv.env.production) || argv.p);

/**
 * Common plugins
 * @type {*[]}
 */
const commonPlugins = [
  new CopyWebpackPlugin([
    {
      from: path.resolve(__dirname, '../images/**/*'),
      to: 'images/',
		context: "./assets/images/"
    }
  ], {

  }),
  new webpack.LoaderOptionsPlugin({
    minimize: isProduction,
    debug: !isProduction,
    stats: { colors: true },
    postcss: [
      autoprefixer({
        browsers: [
          'last 2 versions',
          'android 4',
          'opera 12',
        ],
      }),
    ],
    eslint: {
      failOnWarning: false,
      failOnError: true,
    },
  }),
  new webpack.ProvidePlugin({
    $: 'jquery',
    jQuery: 'jquery',
    'window.jQuery': 'jquery',
    Tether: 'tether',
    'window.Tether': 'tether',
  }),
  new ImageminPlugin({
    disable: !isProduction,
    optipng: {
      optimizationLevel: 7,
    },
    gifsicle: {
      optimizationLevel: 3,
    },
    pngquant: {
      quality: '65-90',
      speed: 4,
    },
    svgo: null,
    jpegtran: null,
    plugins: [imageminMozjpeg({
      quality: 75,
    })]
  }),
    new MiniCssExtractPlugin({
        // Options similar to the same options in webpackOptions.output
        // both options are optional
        filename: 'styles/[name].css',
        chunkFilename: "[id].css"
    })
];

/**
 * Develop plugins
 * @type {Array.<*>}
 */
const developPlugins = [
  // new DashboardPlugin(),
  new BrowserSyncPlugin({
    proxy: 'http://localhost:8080', // The default webpack-url
    open: false,
    files: [{
      match: [
        '**/*.{php,jpg,jpeg,gif,png,svg}'
      ],
      fn: function (e) {
        if (e === 'change' || e === 'add' || e === 'unlink') {
          const bs = require('browser-sync').get('bs-webpack-plugin');
          bs.reload();
        }
      }
    }],
    // rewriteRules: [{
    //   // Don't serve images from /dist on dev-server
    //   match: /(assets\/.*?\.(png|jpe?g|svg|gif))/g,
    //   fn: function (req, res, match) {
    //     return match.replace('/dist', '');
    //   }
    // }]
  },
  {
    reload: false
  }),
  new webpack.optimize.OccurrenceOrderPlugin(),
  new webpack.NoEmitOnErrorsPlugin()
];

/**
 * Production plugins
 * @type {Array.<*>}
 */
const productionPLugins = [
  new WebpackCleanupPlugin(),
  new webpack.optimize.OccurrenceOrderPlugin(),
    new UglifyJsPlugin({
        uglifyOptions: {
            ecma: 5,
			warnings: true,
            compress: {
                drop_console: true
            },
        },
    }),
  new OptimizeCssAssetsPlugin({
    cssProcessorOptions: {
      discardComments: {
        removeAll: true
      },
      safe: true,
    }
  })
];

module.exports = {
  develop: commonPlugins.concat(developPlugins),
  production: commonPlugins.concat(productionPLugins)
};
