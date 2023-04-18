<?php
    //資料庫連線
    require_once ("getConn_nopush.php");

    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);


    //建立SQL語法
    $sql = "SELECT d.ID, d.TITLE as '文章標題',  dt.CATEGORY as '文章分類', u.ACCOUNT as '作者', d.CREATE_TIME as '建立日期', ds.STATUS_NAME as '狀態'
        FROM DISCUSS as d
        join USER as u on d.USER_ID = u.ID
        join DISCUSS_TYPE as dt on d.DISCUSS_TYPE_ID = dt.ID
        join DISCUSS_STATUS as ds on d.DISCUSS_STATUS_ID = ds.ID
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
