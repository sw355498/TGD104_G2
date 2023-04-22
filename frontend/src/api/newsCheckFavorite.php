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
// print_r($news_id);

// 查詢該會員是否已收藏過該新聞
$sql = "SELECT * FROM NEWS_COLLECT WHERE USER_ID = :user_id AND NEWS_ID = :news_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $token);
$stmt->bindValue(':news_id', $news_id);
$stmt->execute();
$result = $stmt->fetchAll();

if (count($result) > 0) {
    // 該會員已收藏過該新聞
    echo json_encode(['success' => true, 'is_favorite' => true]);
} else {
    // 該會員尚未收藏過該新聞
    echo json_encode(['success' => true, 'is_favorite' => false]);
}
?>