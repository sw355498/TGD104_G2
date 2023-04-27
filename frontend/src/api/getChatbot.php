<?php 

    require_once("./getConn_nopush.php");
    $data = [];
    $sql = "SELECT * FROM CHATBOT WHERE STATUS = 1";
    $statement = $pdo->prepare($sql);
    $statement-> execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);

?>