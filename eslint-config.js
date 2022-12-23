const config = {
    parser: "babel-eslint",
    extends: [
        "prettier",
        "eslint:recommended",
        "plugin:react/recommended",
        "plugin:import/errors",
    ],
    plugins: ["import", "react-hooks", "simple-import-sort"],
    parserOptions: {
        sourceType: "module",
        ecmaVersion: 2017,
        ecmaFeatures: {
            jsx: true,
        },
    },
    settings: {
        "import/core-modules": ["jquery"],
        "import/resolver": {
            node: {
                extensions: [".js", ".jsx", ".ts", ".tsx"],
            },
        },
        react: {
            version: "detect",
        },
    },
    env: {
        browser: true,
        node: true,
    },
    rules: {
        // "simple-import-sort/sort": "warn",
        "react-hooks/rules-of-hooks": "error",
        "react-hooks/exhaustive-deps": "warn",
        "no-console": 0,
        "react/prop-types": 0,
        "no-unused-vars": "warn",
        "prefer-arrow-callback": "warn",
        eqeqeq: ["error", "smart"],
    },
};

if (process.env.ESLINT_IMPORTS) {
    config.rules["simple-import-sort/sort"] = "warn";
}

module.exports = config;
