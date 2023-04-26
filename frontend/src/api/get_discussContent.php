<?php
    // 資料庫連線
    require_once ("./getConn_nopush.php");

    // 取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");

    // 將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    $discussId = (isset($data['id']) ? $data['id'] : '');
    
    //建立SQL語法
    $sql = "SELECT D.ID, D.USER_ID, U.NICKNAME, D.TITLE, DT.CATEGORY, substring(D.CREATE_TIME, 1, 10) as CREATE_TIME, D.CONTENT
            from DISCUSS D
            JOIN DISCUSS_TYPE DT
            ON D.DISCUSS_STATUS_ID = DT.ID
            JOIN USER U
            ON D.USER_ID = U.ID
            WHERE D.ID = :id";

    //執行並查詢
    $statement = $pdo->prepare($sql);
    $statement -> bindValue(':id', $discussId);
    $statement -> execute();
    $data = $statement->fetchAll();

    foreach($data as &$row){
        $row['CONTENT'] = htmlspecialchars_decode($row['CONTENT']);
        $row['CONTENT'] = strip_tags($row['CONTENT']);
    }

    echo json_encode($data);
?>