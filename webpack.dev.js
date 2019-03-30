const merge = require('webpack-merge');
const common = require('./webpack.config.js');

module.exports = merge(common, {
    mode: 'development',
    devtool: 'source-map',
    output: {
        devtoolModuleFilenameTemplate: (info) => {
            const isJsFile = info.resourcePath.match(/^\.\/js_modules\/.*\.js$/);
            return `webpack:///${isJsFile ? info.resourcePath.replace('./', '') : info.resourcePath}`;
        }
    }
});
