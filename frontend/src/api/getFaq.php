<?php 

  include("./getConn_nopush.php");

  $sql = "SELECT * from QA" ; 
  $statement = $pdo->prepare($sql);

  $statement-> execute();
  $data = $statement->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($data);

?>