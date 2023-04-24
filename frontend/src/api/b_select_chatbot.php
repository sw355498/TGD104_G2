<?php 
    require_once("./getConn_nopush.php");

    //建立SQL語法
    $sql = "SELECT ID, BTN AS '按鈕', KEYWORD AS '關鍵字', MESSAGE AS '回答', CONTENT AS '內容' 
    FROM CHATBOT 
    WHERE `STATUS` = 1
    ORDER BY ID DESC;";

    $statement = $pdo->prepare($sql);
    $statement->execute();

     //抓出全部且依照順序封裝成一個二維陣列
    //PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    //將資料型別轉換成陣列
    $result = array('data' => $data);
    echo json_encode($result);
?>