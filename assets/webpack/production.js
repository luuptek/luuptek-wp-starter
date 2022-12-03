const { merge } = require('webpack-merge');
const webpackBase = require('./webpack.base.js');
const plugins = require('./plugins');
const TerserPlugin = require("terser-webpack-plugin");

module.exports = merge(webpackBase, {
  plugins: plugins.production,
	optimization: {
		minimize: true,
		minimizer: [new TerserPlugin()],
	},
});
