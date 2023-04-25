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
    $url_id = isset($data['id']) ? $data['id'] : 0;

    // 建立 SQL 語法
    $sql = "DELETE FROM `URL` WHERE USER_ID = :user_id AND ID = :url_id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $token);
    $stmt->bindValue(':url_id', $url_id);
    $stmt->execute();

    print_r($token);
    // 回傳刪除資料筆數
    $result = array('success' => $stmt->rowCount());
    $errorInfo = $stmt->errorInfo();
if ($errorInfo[0] !== PDO::ERR_NONE) {
    die("Error: " . $errorInfo[2]);
}

    echo json_encode($result);
?>