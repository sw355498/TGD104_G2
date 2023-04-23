<?php
    require_once("./getConn_nopush.php");
    $data = json_decode(file_get_contents('php://input'), true);
    $sql = "INSERT INTO URL(TITLE, URL, DATE, NOTES, MAIL, USER_ID) 
    VALUES (:TITLE, :URL, NOW(), :NOTES, :MAIL, :USER_ID)";

    print_r($data);
    //---------------------------------------------------
    // //執行
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':TITLE', $data["title"]);
    $statement->bindValue(':URL', $data["url"]);
    $statement->bindValue(':NOTES', $data["notes"]);
    $statement->bindValue(':MAIL', $data["email"]);
    $statement->bindValue(':USER_ID', $data["token"]);
    $statement-> execute();
    
    echo "新增成功!";
?>