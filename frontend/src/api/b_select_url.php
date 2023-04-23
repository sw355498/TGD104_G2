<?php
    //資料庫連線
    require_once ("getConn_nopush.php");

    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);


    //建立SQL語法
    $sql = "SELECT ur.TITLE AS '網站名稱', ur.URL AS '網址', u.ACCOUNT AS '回報人', DATE_FORMAT(ur.DATE, '%Y/%m/%d') AS '回報日期', us.STATUS_NAME AS '回報狀態'
        FROM URL AS ur
        JOIN USER AS u ON ur.USER_ID = u.ID
        JOIN URL_STATUS AS us ON ur.URL_STATUS = us.ID
        ORDER BY u.ID DESC;";

    $statement = $pdo->prepare($sql);
    $statement->execute();

    //抓出全部且依照順序封裝成一個二維陣列
    //PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    //將資料型別轉換成陣列
    $result = array('data' => $data);
    echo json_encode($result);
?>
