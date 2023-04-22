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
   $displayName = isset($data['NICKNAME']) ? $data['NICKNAME'] : '';
   $phoneNumber = isset($data['MOBILE']) ? $data['MOBILE'] : '';
   $birthday = isset($data['BIRTH']) ? $data['BIRTH'] : '';

   // 判斷是否有傳入要修改的欄位，若無則結束程式
   if (empty($displayName) && empty($phoneNumber) && empty($birthday)) {
       die("No data to update");
   }

   // 建立 SQL 語法，更新 USER table 中該會員的資料
   $sql = "UPDATE USER SET ";
$bindValues = array();
if (!empty($displayName)) {
    $sql .= "NICKNAME = :displayName, ";
    $bindValues[':displayName'] = $displayName;
}
if (!empty($phoneNumber)) {
    $sql .= "MOBILE = :phoneNumber, ";
    $bindValues[':phoneNumber'] = $phoneNumber;
}
if (!empty($birthday)) {
    $sql .= "BIRTH = :birthday, ";
    $bindValues[':birthday'] = $birthday;
}
// 刪除最後一個逗號
$sql = rtrim($sql, ", ");
$sql .= " WHERE ID = :id";
$bindValues[':id'] = $token;
$statement = $pdo->prepare($sql);
$statement->execute($bindValues);
   // 回傳成功訊息
   echo "Data updated successfully!";
?>