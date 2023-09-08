const path = require('path');
const argv = require('minimist')(process.argv.slice(2));
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const config = require('../../package.json').config;

const isProduction = !!(argv.mode && argv.mode === 'production');
// A bit nonsense, yet works...
const publicPath = `/${path.dirname(process.cwd()).split(path.sep).slice(-2).concat(path.basename(process.cwd())).join('/')}/assets/dist/`;
const entry = {};

Object.keys(config.entries).forEach(function (id) {
	entry[id] = config.entries[id];
});

module.exports = {
	entry: entry,
	output: {
		path: path.resolve(__dirname, '../dist'),
		publicPath: publicPath,
		filename: 'scripts/[name].min.js',
		sourceMapFilename: '[name].[hash].js.map',
		chunkFilename: '[id].chunk.js'
	},
	resolve: {
		fallback: { "url": require.resolve("url/") },
		extensions: ['.js', '.html'],
		alias: {
			src: path.resolve(__dirname, '../'),
		},
	},
	devServer: {
		allowedHosts: 'all',
		bonjour: false,
		client: {
			logging: 'info',
			overlay: true,
			progress: true,
			reconnect: 10
		},
		compress: true,
		host: 'localhost',
		hot: true,
		proxy: {
			'/': {
				target: config.proxyUrl,
				secure: false,
				changeOrigin: true,
				autoRewrite: true,
			},
		},
		static: {
			publicPath: `http://localhost:8080${publicPath}`,
		}
	},
	externals: {
		jquery: 'jQuery'
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				include: path.resolve(__dirname, '../'),
				loader: 'babel-loader'
			},
			{
				test: /\.css$/,
				use: [
					'css-hot-loader',
					isProduction ? MiniCssExtractPlugin.loader : 'style-loader',
					{
						loader: 'css-loader',
						options: {
							sourceMap: !isProduction
						}
					}
				]
			},
			{
				test: /\.scss$/,
				use: [
					'css-hot-loader',
					isProduction ? MiniCssExtractPlugin.loader : 'style-loader',
					{
						loader: 'css-loader',
						options: {
							sourceMap: !isProduction
						}
					},
					{
						loader: 'sass-loader',
						options: {
							sourceMap: !isProduction
						}
					}
				]
			},
            {
                test: /\.svg$/,
                oneOf: [
                    {
                        exclude: path.resolve(__dirname, '../images'),
                        type: 'asset/resource',
                        generator: {
                            filename: 'vendor/[name][ext]'
                        }
                    },
                    {
                        include: path.resolve(__dirname, '../images'),
                        type: 'asset/resource',
                        generator: {
                            filename: 'images/[name][ext]'
                        }
                    },
                ],
            },
            {
                test: /\.(png|jpe?g|gif)$/,
                type: 'asset/resource',
                generator: {
                    filename: 'images/[name][ext]'
                }
            },
            {
                test: /\.(woff2?|ttf|eot|xml|json)(\?v=[a-z0-9]\.[a-z0-9]\.[a-z0-9])?$/,
                type: 'asset/resource',
                generator: {
                    filename: 'vendor/[name][ext]'
                }
            },
		]
	}
};
