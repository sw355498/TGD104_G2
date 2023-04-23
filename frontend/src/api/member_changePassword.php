<?php
   // 資料庫連線
   require_once ("./getConn_nopush.php");

   // 取得 HTTP POST  Client 端所傳送過來的原始資料
   $postData = file_get_contents("php://input");

   // 將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
   $data = json_decode($postData, true);

   // 取得傳入的 token (此處假設 token 內容為會員 ID)
   $token = isset($data['token']) ? $data['token'] : '';

   // 取得 POST 傳來的資料
   $oldPassword = isset($data['oldPassword']) ? $data['oldPassword'] : '';
   $newPassword = isset($data['newPassword']) ? $data['newPassword'] : '';

   // 檢查是否有欄位為空
   if (empty($token) || empty($oldPassword) || empty($newPassword)) {
       die("Missing required fields");
   }

   // 檢查舊密碼是否正確
   $stmt = $pdo->prepare("SELECT * FROM USER WHERE ID = :id");
   $stmt->execute(array(":id" => $token));
   $user = $stmt->fetch(PDO::FETCH_ASSOC);
   if (!$user || !password_verify($oldPassword, $user['PASSWORD'])) {
       die("Incorrect password");
   }

   // 更新密碼
   $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
   $stmt = $pdo->prepare("UPDATE USER SET PASSWORD = :newPassword WHERE ID = :id");
   $stmt->execute(array(":newPassword" => $newPasswordHash, ":id" => $token));

   // 回傳成功訊息
   echo "Password updated successfully!";
?>