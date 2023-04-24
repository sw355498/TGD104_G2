<?php
   //資料庫連線
   require_once ("./getConn_nopush.php");

  // 取得傳入的 token (此處假設token內容為會員ID)
  $token = $_GET['token'];

  // 建立 SQL 語法，從 USER table 中取得該會員資料
  $sql = "SELECT * FROM USER WHERE ID = :id";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(':id', $token, PDO::PARAM_INT);
  $statement->execute();

  // 抓出該會員資料
  $member = $statement->fetchAll(PDO::FETCH_ASSOC);

  // 建立 SQL 語法，取得指定會員ID的回報數總數
  $sql_count = "SELECT COUNT(*) as count FROM URL WHERE USER_ID = :id";
  $statement_count = $pdo->prepare($sql_count);
  $statement_count->bindValue(':id', $token, PDO::PARAM_INT);
  $statement_count->execute();
  $count = $statement_count->fetch(PDO::FETCH_ASSOC)['count'];

  // 建立 SQL 語法，留言次數
  $sql_count = "SELECT COUNT(*) as count FROM `MESSAGE` WHERE USER_ID = :id";
  $statement_count = $pdo->prepare($sql_count);
  $statement_count->bindValue(':id', $token, PDO::PARAM_INT);
  $statement_count->execute();
  $countMessage = $statement_count->fetch(PDO::FETCH_ASSOC)['count'];



  // 回傳該會員資料
  echo json_encode([
    'member' => $member,
    'count' => $count,
    'countMessage' => $countMessage,
  ]);
?>






