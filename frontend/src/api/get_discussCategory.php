<?php
    // 資料庫連線
    require_once ("./getConn_nopush.php");

    //建立SQL語法
    $sql = "SELECT * from DISCUSS_TYPE";

    //執行並查詢
    $statement = $pdo->prepare($sql);;
    $statement -> execute();
    $data = $statement->fetchAll();
    
    echo json_encode($data);

?>