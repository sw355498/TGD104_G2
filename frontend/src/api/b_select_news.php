<?php
    //資料庫連線
    require_once ("getConn_nopush.php");

    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);


    //建立SQL語法
    $sql = "SELECT ID, NEWS_TITLE AS '標題', NEWS_CATEGORY AS '分類', NEWS_CONTENT AS '內容', DATE_FORMAT(CREATE_DATE, '%Y/%m/%d') AS '建立日期' 
    FROM NEWS
    WHERE NEWS_STATUS = 1
    ORDER BY ID DESC;";

    $statement = $pdo->prepare($sql);
    $statement->execute();

    //抓出全部且依照順序封裝成一個二維陣列
    //PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    //將資料型別轉換成陣列
    $result = array('data' => $data);
    echo json_encode($result);
?>
