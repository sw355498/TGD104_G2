<?php
   //資料庫連線
   require_once ("getConn_nopush.php");

  // 取得傳入的 token (此處假設token內容為會員ID)
  $token = $_GET['token'];

  // 建立 SQL 語法，從 USER table 中取得該會員資料
  $sql = "SELECT * FROM USER WHERE ID = :id";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(':id', $token, PDO::PARAM_INT);
  $statement->execute();

  // 抓出該會員資料
  $member = $statement->fetch(PDO::FETCH_ASSOC);

  // 回傳該會員資料
  echo json_encode($member);
?>






