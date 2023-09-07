const { merge } = require('webpack-merge');
const fs = require('fs');
const webpackBase = require('./webpack.base.js');
const plugins = require('./plugins');
const TerserPlugin = require("terser-webpack-plugin");

module.exports = merge(webpackBase, {
    plugins: [
        ...plugins.production,
        {
            apply: (compiler) => {
                compiler.hooks.beforeCompile.tapAsync('DeleteDevOngoingFilePlugin', (params, callback) => {
                    if (fs.existsSync('.DEV-ONGOING')) {
                        fs.unlink('.DEV-ONGOING', (err) => {
                            if (err) throw err;
                            console.log('.DEV-ONGOING file has been deleted.');
                            callback();
                        });
                    } else {
                        callback();
                    }
                });
            }
        }
    ],
    optimization: {
        minimize: true,
        minimizer: [new TerserPlugin({
            extractComments: false
        })],
    }
});

