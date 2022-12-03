const webpack = require('webpack');
const path = require('path');
const argv = require('minimist')(process.argv.slice(2));
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const WebpackCleanupPlugin = require('webpack-cleanup-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const ESLintPlugin = require('eslint-webpack-plugin');
const myEslintOptions = {
	extensions: [`js`, `jsx`, `ts`],
	exclude: [`node_modules`],
};

const pkg = require('../../package.json');

const isProduction = !!((argv.env && argv.env.production) || argv.p);

/**
 * Common plugins
 * @type {*[]}
 */
const commonPlugins = [
	new CopyWebpackPlugin({
		patterns: [
			{
				from: path.resolve(__dirname, '../images/**/*'),
				to: 'images/',
				context: "./assets/images/"
			}
		],
		options: {
			concurrency: 100,
		},
	}),
	new webpack.LoaderOptionsPlugin({
		minimize: isProduction,
		debug: !isProduction,
		stats: {colors: true},
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
	new MiniCssExtractPlugin({
		// Options similar to the same options in webpackOptions.output
		// both options are optional
		filename: 'styles/[name].css',
		chunkFilename: "[id].css"
	}),
	new ESLintPlugin(myEslintOptions)
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
		})
];

/**
 * Production plugins
 * @type {Array.<*>}
 */
const productionPLugins = [
	new WebpackCleanupPlugin()
];

module.exports = {
	develop: commonPlugins.concat(developPlugins),
	production: commonPlugins.concat(productionPLugins)
};
