const { merge } = require('webpack-merge');
const fs = require('fs');

const webpackBase = require('./webpack.base.js');
const plugins = require('./plugins');

const deleteDevOngoingFile = () => {
    if (fs.existsSync('.DEV-ONGOING')) {
        fs.unlinkSync('.DEV-ONGOING');
        console.log('.DEV-ONGOING file has been deleted.');
    }
};

// Listen for interrupt and termination signals
process.on('SIGINT', deleteDevOngoingFile);
process.on('SIGTERM', deleteDevOngoingFile);

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
