const { defineConfig } = require('@vue/cli-service')
const webpack = require("webpack")

module.exports = defineConfig({
    transpileDependencies: true,

    configureWebpack: {
        plugins: [
            //jQuery 設定
            new webpack.ProvidePlugin({
                $:"jquery",
                jQuery:"jquery", "windows.jQuery":"jquery"
            }),
        ]
    },
    chainWebpack: config => {
        const rule = config.module.rule('svg');
        
        rule.uses.clear();
    
        rule
          .use('babel-loader')
            .loader('babel-loader')
            .end()
          .use('vue-svg-loader')
            .loader('vue-svg-loader')
            .options({
              svgo: {
                plugins: [{ removeDimensions: true }, { removeViewBox: false }]
              }
            })
      }
})
