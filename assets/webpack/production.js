const { merge } = require("webpack-merge");
const fs = require("fs");
const webpackBase = require("./webpack.base.js");
const plugins = require("./plugins");
const TerserPlugin = require("terser-webpack-plugin");
const { exec } = require("child_process"); // Import the exec method

module.exports = merge(webpackBase, {
    plugins: [
        ...plugins.production,
        {
            apply: (compiler) => {
                compiler.hooks.beforeCompile.tapAsync(
                    "PrettifyAndDeleteDevOngoingFilePlugin",
                    (params, callback) => {
                        // First run the yarn prettify command
                        exec("yarn prettify", (error, stdout, stderr) => {
                            if (error) {
                                console.error(`exec error: ${error}`);
                                return callback(error);
                            }
                            console.log(stdout);
                            console.error(stderr);

                            // Then check and delete .DEV-ONGOING file
                            if (fs.existsSync(".DEV-ONGOING")) {
                                fs.unlink(".DEV-ONGOING", (err) => {
                                    if (err) throw err;
                                    console.log(
                                        ".DEV-ONGOING file has been deleted.",
                                    );
                                    callback();
                                });
                            } else {
                                callback();
                            }
                        });
                    },
                );
            },
        },
    ],
    optimization: {
        minimize: true,
        minimizer: [
            new TerserPlugin({
                extractComments: false,
            }),
        ],
    },
});
