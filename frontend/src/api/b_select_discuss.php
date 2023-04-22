<?php
    //資料庫連線
    require_once ("getConn_nopush.php");

    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);


    //建立SQL語法
    $sql = "SELECT d.ID, d.TITLE AS '文章標題',  dt.CATEGORY AS '文章分類', u.ACCOUNT AS '作者', d.CREATE_TIME AS '建立日期', ds.STATUS_NAME AS '狀態'
        FROM DISCUSS AS d
        JOIN USER AS u ON d.USER_ID = u.ID
        JOIN DISCUSS_TYPE AS dt ON d.DISCUSS_TYPE_ID = dt.ID
        JOIN DISCUSS_STATUS AS ds ON d.DISCUSS_STATUS_ID = ds.ID
        WHERE d.DISCUSS_STATUS_ID NOT IN (2 ,4) 
        ORDER BY d.ID DESC;";

    $statement = $pdo->prepare($sql);
    $statement->execute();

    //抓出全部且依照順序封裝成一個二維陣列
    //PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    //將資料型別轉換成陣列
    $result = array('data' => $data);
    echo json_encode($result);
?>
