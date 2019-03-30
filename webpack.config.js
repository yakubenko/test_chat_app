const devServerHost = 'http://localhost';
const devServerPort = 9009;
const assetsFolderName = 'webroot/js/dist';
const publicPath = '/test/webroot/js/dist/';

const path = require('path');
const webpack = require('webpack');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const VueLoaderPlugin = require('vue-loader/lib/plugin');

const envMode = process.env.NODE_ENV;
const hotReload = process.env.HOT_RELOAD;

module.exports = {
    entry: {
        room: './js_modules/room.js',
    },
    mode: envMode,
    resolve: {
        alias: {
            vue$: 'vue/dist/vue.esm.js'
        }
    },
    output: {
        filename: () => '[name].js',
        chunkFilename: '[name].chunk.js',
        path: path.resolve(__dirname, assetsFolderName),
        publicPath: (hotReload === 'true') ? (`${devServerHost}:${devServerPort}/js/dist/`) : publicPath,
    },
    optimization: {
        splitChunks: {
            automaticNameDelimiter: '-',
            cacheGroups: {
                vendors: {
                    test: /[\\/]node_modules[\\/]/,
                    priority: -20,
                    name: 'vendors',
                    chunks: 'initial'
                }
            }
        }
    },
    module: {
        rules: [
            {
                test: /\.sass$/,
                use: [
                    'vue-style-loader',
                    'css-loader',
                    {
                        loader: 'sass-loader',
                        options: {
                            indentedSyntax: true
                        }
                    }
                ]
            },
            {
                test: /\.less$/,
                use: [
                    'vue-style-loader',
                    'css-loader',
                    'less-loader'
                ]
            },
            {
                test: /\.css$/,
                use: [
                    'style-loader', 'css-loader'
                    // MiniCssExtractPlugin.loader, 'css-loader'
                ]
            },
            {
                test: /\.(jpg|jpeg|png|gif)$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: { name: 'img/[hash].[ext]' }
                    }
                ]
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                resourceQuery: /blockType=i18n/,
                loader: '@kazupon/vue-i18n-loader'
            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                include: [ // use `include` vs `exclude` to white-list vs black-list
                    path.resolve(__dirname, 'js_modules'), // white-list your app source files
                ],
                use: {
                    loader: 'babel-loader'
                }
            }
        ]
    },
    plugins: [
        new CleanWebpackPlugin(['webroot/js/dist']),
        new VueLoaderPlugin(),

        new webpack.ContextReplacementPlugin(
            /moment[/\\]locale$/,
            /ru|en/
        )
    ],
    devServer: {
        contentBase: path.join(__dirname, assetsFolderName),
        compress: true,
        disableHostCheck: true,
        port: devServerPort,
        public: 'localhost:9009',
        publicPath: '/js/dist/',
        // watchOptions: {
        //     poll: true
        // },
        overlay: {
            warnings: true,
            errors: true
        },
        headers: {
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Headers': '*'
        }
    }
};
