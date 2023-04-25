<?php 

include("./getConn_nopush.php");
$data = [];

    $sql = "SELECT * from DISCUSS WHERE DISCUSS_STATUS_ID = 1
    order by CREATE_TIME DESC" ; 
    $statement = $pdo->prepare($sql);
   
    $statement-> execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);//引用table表頭
    
    echo json_encode($data);

?>