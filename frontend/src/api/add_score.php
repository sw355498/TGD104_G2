<?php
// 資料庫連線
require_once ("getConn_nopush.php");

// 取得傳入的 token (此處假設token內容為會員ID)
$token = $_POST['token'];

// 取得分數
$score = $_POST['score'];

// 建立 SQL 語法，更新 USER table 中該會員的 quiz 欄位
$sql = "UPDATE USER SET QUIZ = :score WHERE ID = :id";
$statement = $pdo->prepare($sql);
$statement->bindValue(':score', $score, PDO::PARAM_INT);
$statement->bindValue(':id', $token, PDO::PARAM_INT);
$statement->execute();

// 回傳成功訊息
echo json_encode(['success' => true]);
?>