<?php
    // 資料庫連線
    require_once ("./getConn_nopush.php");

    // 取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");

    // 將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    $discussId = isset($data['discussId']) ? htmlspecialchars($data['discussId']) : '';
    
    //建立SQL語法
    $sql = "SELECT M.ID, U.PIC as img, U.NICKNAME as user, M.CONTENT as content from MESSAGE M JOIN USER U on M.USER_ID = U.ID WHERE M.DISCUSS_ID = :DISCUSS_ID";

    //執行並查詢
    $statement = $pdo->prepare($sql);
    $statement -> bindValue(':DISCUSS_ID', $discussId);
    $statement -> execute();

    //抓出全部且依照順序封裝成一個二維陣列
    $data = $statement->fetchAll();

    foreach($data as &$row){
        $row['content'] = htmlspecialchars_decode($row['content']);
        $row['content'] = strip_tags($row['content']);
    }

    echo json_encode($data);

?>