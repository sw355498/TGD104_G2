<?php
    //資料庫連線
    require_once ("./getConn_nopush.php");

    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    // 取得傳入的 token (此處假設 token 內容為會員 ID)
    $token = isset($data['token']) ? $data['token'] : '';

    // 取得 POST 資料
    $post_id = isset($data['id']) ? $data['id'] : 0;

    // 建立 SQL 語法
    $sql = "UPDATE DISCUSS
    SET DISCUSS_STATUS_ID = 4
    WHERE USER_ID = :user_id
    AND ID = :post_id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $token);
    $stmt->bindValue(':post_id', $post_id);
    $stmt->execute();

    // print_r($token);
    // print_r($post_id);
    // 回傳刪除資料筆數
    $result = array('success' => $stmt->rowCount());


    echo json_encode($result);
?>