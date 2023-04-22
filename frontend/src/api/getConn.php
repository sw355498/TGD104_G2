<?php
 //MySQL相關資訊
       $db_host = "127.0.0.1";
       $db_user = "";
       $db_pass = "";
       $db_select = "";

       //建立資料庫連線物件
       $dsn = "mysql:host=".$db_host.";dbname=".$db_select.";charset=utf8";

       //建立PDO物件，並放入指定的相關資料
       $pdo = new PDO($dsn, $db_user, $db_pass);

       //上傳圖片的相對路徑
       $addImageUrl = '../assets/img/'
//---------------------------------------------------

    // 建立一個 Express application 物件
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

?>