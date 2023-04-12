<?php
    include("./getConn_nopush.php");
    // 拿到input值 對他 htmlspecialchars
    $USER_ID = htmlspecialchars($_POST["USER_ID"]);
    echo $account;
    echo "<br>";
    $TITLE = htmlspecialchars($_POST["TITLE"]);
    $URL = htmlspecialchars($_POST["URL"]);
    $NOTES = htmlspecialchars($_POST["NOTES"]);
    $MAIL = htmlspecialchars($_POST["MAIL"]);
    echo $psw;
    echo "<br>";

    include("Conn.php");

    //---------------------------------------------------

    //建立SQL
    // $sql = "INSERT INTO member(Account, PWD, CreateDate) VALUES ($account, $psw, NOW())";
    // $sql = "INSERT INTO member(Account, PWD, CreateDate) VALUES ('王小明', 'abc123', NOW())";
    $sql = "INSERT INTO URL(USER_ID, TITLE, URL, DATE, NOTES, MAIL) VALUES ('$USER_ID','$TITLE', '$URL', NOW(), '$NOTES', '$MAIL')";

    //執行
    $pdo->exec($sql);
    
    echo "新增成功!";
    // PHP轉址: header("Location: Select.php");
    // header("Location: Select.php");

?>