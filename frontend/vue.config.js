const { defineConfig } = require('@vue/cli-service')
const webpack = require("webpack")
const path = require('path')

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
      // 先刪除預設的svg配置
      config.module.rules.delete("svg")
      
      // 新增 svg-sprite-loader 設定
      config.module
        .rule("svg-sprite-loader") 
        .test(/\.svg$/)
        .include
        .add(path.resolve(__dirname, "src/assets/icon"))
        .end()
        .use("svg-sprite-loader")
        .loader("svg-sprite-loader")
        .options({ symbolId: "[name]" })
        
      // 修改 images-loader 配置
      config.module
        .rule("images")
        .exclude.add(path.resolve(__dirname, "src/assets/icon"))
    }
})
