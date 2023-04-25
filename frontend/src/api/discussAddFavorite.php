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


// 將收藏資料存入資料庫
$sql = "INSERT INTO DISCUSS_COLLECT (USER_ID, DISCUSS_ID, CREATE_TIME) VALUES (:userId, :discussId, NOW())";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':userId', $token);
$stmt->bindValue(':discussId', $discuss_id);
$result = $stmt->execute();

if (!$result) {
    die(json_encode(['success' => false, 'msg' => '收藏失敗']));
}

echo json_encode(['success' => true]);


?>