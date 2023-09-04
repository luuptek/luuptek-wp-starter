const { merge } = require('webpack-merge');
const fs = require('fs');

const webpackBase = require('./webpack.base.js');
const plugins = require('./plugins');

module.exports = merge(webpackBase, {
    devtool: 'eval',
    plugins: [
        ...plugins.develop,
        {
            apply: (compiler) => {
                compiler.hooks.beforeCompile.tapAsync('CreateDevOngoingFilePlugin', (params, callback) => {
                    fs.writeFile('.DEV-ONGOING', '', (err) => {
                        if (err) throw err;
                        console.log('.DEV-ONGOING file has been created.');
                        callback();
                    });
                });
            }
        }
    ]
});

