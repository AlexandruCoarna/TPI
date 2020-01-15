const path = require("path");

module.exports = {
    entry: {
        'add-student': './src/add-student',
        'student-list': './src/student-list'
    },
    mode: 'production',
    module: {
        rules: [
            {
                test: /\.ts$/,
                use: 'ts-loader',
            },
        ],
    },
    resolve: {
        extensions: [
            '.ts',
        ],
    },
    output: {
        filename: '[name].bundle.js',
        path: path.resolve(__dirname, './public/bundles'),
    },
    optimization: {
        splitChunks: {
            chunks: 'all',
        },
    },
};
