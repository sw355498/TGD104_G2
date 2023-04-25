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
$discuss_id = isset($data['discuss_id']) ? $data['discuss_id'] : 0;
// print_r($discuss_id);

// 查詢該會員是否已收藏過該新聞
$sql = "SELECT * FROM DISCUSS_COLLECT WHERE USER_ID = :user_id AND DISCUSS_ID = :discuss_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $token);
$stmt->bindValue(':discuss_id', $discuss_id);
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