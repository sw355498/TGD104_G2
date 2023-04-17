<?php
    //資料庫連線
    require_once ("getConn_nopush.php");

    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    $userStatusId = $data['userStatusId'];
    $userID = $data['userID'];


    //建立SQL語法
    $sql = "UPDATE USER SET USER_STATUS_ID = :userStatusId WHERE ID = :userID";

    $statement = $pdo->prepare($sql);

    //綁定變數
    $statement ->bindValue(":userStatusId", $userStatusId);
    $statement ->bindValue(":userID", $userID);

    $statement->execute();

    echo "資料更新成功";
?>
