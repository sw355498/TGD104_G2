<?php
    require_once("./getConn_nopush.php");
    $data = json_decode(file_get_contents('php://input'), true);

    // $TITLE = htmlspecialchars($data["title"]);
    // $URL = htmlspecialchars($data["url"]);
    // $NOTES = htmlspecialchars($data["notes"]);
    // $MAIL = htmlspecialchars($data["email"]);

    $sql = "INSERT INTO URL(TITLE, URL, DATE, NOTES, MAIL) 
    VALUES (:TITLE, :URL, :DATE, :NOTES, :MAIL)";

    print_r($data);
    echo $data["title"];
    // print_r($pdo);
    //---------------------------------------------------
    // //執行
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':TITLE', $data["title"]);
    $statement->bindValue(':URL', $data["url"]);
    $statement->bindValue(':DATE', $data["date"]);
    $statement->bindValue(':NOTES', $data["notes"]);
    $statement->bindValue(':MAIL', $data["email"]);
    $statement-> execute();
    
    echo "新增成功!";
?>