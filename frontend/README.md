# frontend

## Project setup

```
npm install
```

### Compiles and hot-reloads for development

```
npm run serve
```

### Compiles and minifies for production

```
npm run build
```

### Customize configuration

See [Configuration Reference](https://cli.vuejs.org/config/).

###

vue 檔案引入 svg 圖檔方式

<!-- <svg><use xlink:href="#svg圖檔名稱" /></svg> -->

```
<svg><use xlink:href="#svg圖檔名稱" /></svg>
```

### axios

請於 getConn.php 輸入資料庫帳號/密碼/名稱再做連線

```
$db_user = "";
$db_pass = "";
$db_select = "";
```

# 詐知就好

防範詐騙教育型網站

## 組員：

全容君(KarenChuan),黃資蓉(candybomb),阮炫瑞(lucyruan0419),林欣妤(itshsinyu),詹皓丞(sw355498),張家恩(bbn718)

## 功能:

前台會員測試帳號密碼

```bash
帳號： amy@example.com
密碼： 123456
```

## 專案技術

- Node.js       v18.13.0
- Vue           v3.2.13
- vue/cli       v5.0.8
- vue-router    v4.0.3
- vue-typed-js  v0.1.2
- sass          v1.32.7
- Axios         v1.3.5
- Bootstrap     v5.2.3
- ckeditor5     v36.0.1
- jsgrid        v1.5.3
- jquery        v3.6.4
- particles-js  v2.0.0
- sweetalert2   v11.7.3
- typed.js      v2.0.15
- typeit        v8.7.1

  ...

## 第三方服務
- Line Developer
- Google Developer
  ...

## 打包注意事項
localhost 與 打包時 請分別至 
config.js、getConn_nopush.php、upload_image.php
開啟相應的設定