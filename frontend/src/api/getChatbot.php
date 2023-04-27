<?php 

    require_once("./getConn_nopush.php");

    //建立SQL語法
    $sql = "select * from chatbot where STATUS = 1";
    $statement = $pdo->prepare($sql);
    $statement-> execute();
    // PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($data);

?>