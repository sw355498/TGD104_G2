<?php
    // 資料庫連線
    require_once ("./getConn_nopush.php");

    // 取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");

    // 將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    // 定義 Client 端的資料
    $messageId = isset($data['messageId']) ? htmlspecialchars($data['messageId']) : '';
    $userId = isset($data['userId']) ? htmlspecialchars($data['userId']) : '';
    $content = isset($data['content']) ? htmlspecialchars($data['content']) : '';
    
    echo $userId;
    // 建立 SQL
    $sql = "INSERT INTO REPLY (MESSAGE_ID, USER_ID, CONTENT, `STATUS`) VALUES (:MESSAGE_ID, :USER_ID, :CONTENT, 1)";
    
    // 執行
    $statement = $pdo -> prepare($sql);

    // 綁定參數
    $statement -> bindValue(':MESSAGE_ID', $messageId);
    $statement -> bindValue(':USER_ID', $userId);
    $statement -> bindValue(':CONTENT', $content);

    // 執行 SQL
    $statement -> execute();

    // 取出剛剛 INSERT INTO 的那筆資料 ID
    $newId = $pdo -> lastInsertId();

    // // 利用其 ID 撈取資料
    // $sql = "SELECT * FROM REPLY WHERE ID = :ID";
    // $statement = $pdo -> prepare($sql);
    // $statement -> bindValue(':ID', $newId);
    // $statement -> execute();
    
    // $result = $statement -> fetch(PDO::FETCH_ASSOC);
    
    // // 將資料封裝成 JSON 形式印出
    // echo json_encode($result);

?>