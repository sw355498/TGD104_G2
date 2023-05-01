<?php
    // 資料庫連線
    require_once ("./getConn_nopush.php");

    // 取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");

    // 將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    // $messageId = isset($data['messageId']) ? htmlspecialchars($data['messageId']) : '';

    //建立SQL語法
    $sql = "SELECT R.MESSAGE_ID, U.PIC as img, U.NICKNAME as user, R.CONTENT as content, R.CREATE_TIME from REPLY R JOIN USER U on R.USER_ID = U.ID";

    //執行並查詢
    $statement = $pdo->prepare($sql);
    // $statement -> bindValue(':MESSAGE_ID', $messageId);
    $statement -> execute();

    //抓出全部且依照順序封裝成一個二維陣列
    $data = $statement->fetchAll();

    foreach($data as &$row){
        $row['content'] = htmlspecialchars_decode($row['content']);
        $row['content'] = strip_tags($row['content']);
    }

    echo json_encode($data);

?>