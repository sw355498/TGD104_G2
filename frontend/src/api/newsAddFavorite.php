<?php
// 資料庫連線
require_once("./getConn_nopush.php");

header('Content-Type: application/json');

// 取得 HTTP POST Client 端所傳送過來的資料
$postData = file_get_contents("php://input");
$data = json_decode($postData, true);

// 取得傳入的 token (此處假設 token 內容為會員 ID) 
$token = isset($data['token']) ? $data['token'] : '';

// 取得 POST 資料
$news_id = isset($data['news_id']) ? $data['news_id'] : 0;

print_r($news_id);

// 將收藏資料存入資料庫
$sql = "INSERT INTO NEWS_COLLECT (USER_ID, NEWS_ID, CREATE_TIME) VALUES (:user_id, :news_id,NOW())";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':user_id', $token);
$stmt->bindValue(':news_id', $news_id);
$result = $stmt->execute();

if (!$result) {
    die(json_encode(['success' => false, 'msg' => '收藏失敗']));
}

echo json_encode(['success' => true]);


?>