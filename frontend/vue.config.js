const { defineConfig } = require('@vue/cli-service')
const webpack = require("webpack")
const path = require('path')
const { CKEditorTranslationsPlugin } = require( '@ckeditor/ckeditor5-dev-translations' );
const { styles } = require( '@ckeditor/ckeditor5-dev-utils' );
const { proxy } = require('jquery');
// const MiniCssExtractPlugin = require('mini-css-extract-plugin');
// const { createProxyMiddleware } = require('http-proxy-middleware');
// const httpProxy = require('http-proxy');
// const proxy = httpProxy.createProxyServer();

module.exports = defineConfig({
    transpileDependencies: [/ckeditor5-[^/\\]+[/\\]src[/\\].+\.js$/],
    // publicPath:'./',

    // 'production-sub-path': process.env.NODE_ENV === 'production'
    // ? '/tgd104/g2/dist/'
    // : '/',

    publicPath: process.env.NODE_ENV === 'production'
    ? '/tgd104/g2/dist/'
    : '/',
    configureWebpack: {
        plugins: [
            //jQuery 設定
            new webpack.ProvidePlugin({
                $:"jquery",
                jQuery:"jquery", "windows.jQuery":"jquery"
            }),
            // new MiniCssExtractPlugin()
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


        // CKEditor設定
        config.module
        .rule('ckeditor')
        .test(/\.ckeditor5\/[^/\\]+\/theme\/icons\/[^/\\]+\.svg$/)
        .use('raw-loader')
        .loader('raw-loader')
        .end();

        config.module
        .rule('vue')
        .use('vue-loader')
        .loader('vue-loader')
        .tap(options => {
          options.compilerOptions = {
            ...options.compilerOptions,
            isCustomElement: tag => tag.startsWith('ckeditor-')
          };
          return options;
        })
        .end();

        config.module
        .rule( 'cke-css' )
        .test( /ckeditor5-[^/\\]+[/\\].+\.css$/ )
        .use( 'postcss-loader' )
        .loader( 'postcss-loader' )
        .tap( () => {
            return {
                postcssOptions: styles.getPostCssConfig( {
                    themeImporter: {
                        themePath: require.resolve( '@ckeditor/ckeditor5-theme-lark' ),
                    },
                    minify: true
                } )
            };
        } );
    },

    // 串api需要的
    devServer: {
        proxy: {
          '/madeByNeil': {
            target: 'https://od.moi.gov.tw',
            changeOrigin: true,
            pathRewrite: {
              '^/madeByNeil': ''
            },
            ws: true
          }
        }
      }
})
