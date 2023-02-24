const { BabelGQLWebpackPlugin } = require("babel-gql/plugin");

/** @type {import("sakke").Config} */
const config = {
	babelPlugins: ["babel-gql/plugin"],
	webpackPlugins: [
		new BabelGQLWebpackPlugin({
			target: ".queries",
		}),
	],
	webpackRules: [],
	compileNodeModules: [],
};

module.exports = config;
