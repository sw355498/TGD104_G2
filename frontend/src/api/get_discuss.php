<?php
    // 資料庫連線
    require_once ("./getConn_nopush.php");

    // 取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");

    // 將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    $search = (isset($data['datas']) ? $data['datas'] : '');
    
    //建立SQL語法
    $sql = "SELECT D.ID, U.NICKNAME, D.TITLE, D.PIC, D.CONTENT, D.NONNAME, D.CREATE_TIME, DT.CATEGORY
            FROM DISCUSS D
            JOIN DISCUSS_TYPE DT ON D.DISCUSS_TYPE_ID = DT.ID
            JOIN USER U ON D.USER_ID = U.ID
            WHERE D.DISCUSS_STATUS_ID = 1
            AND (D.TITLE LIKE '%' :search '%' OR D.CONTENT LIKE '%' :search '%')
            ORDER BY D.ID DESC";

    //執行並查詢
    $statement = $pdo->prepare($sql);
    $statement -> bindValue(":search", $search);
    $statement -> execute();

    //抓出全部且依照順序封裝成一個二維陣列
    $data = $statement->fetchAll();

    foreach($data as &$row){
        $row['CONTENT'] = htmlspecialchars_decode($row['CONTENT']);
        $row['CONTENT'] = strip_tags($row['CONTENT']);
    }

    echo json_encode($data);

?>