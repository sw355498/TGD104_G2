<?php
    //資料庫連線
    require_once ("./getConn_nopush.php");

    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    // 取得傳入的 token (此處假設 token 內容為會員 ID)
    $token = isset($data['token']) ? $data['token'] : '';

    // echo $data;

    // print_r($data);

    // 建立 SQL 語法
    $sql = "SELECT *
    FROM DISCUSS U
    INNER JOIN DISCUSS_STATUS S ON U.DISCUSS_STATUS_ID = S.ID
    WHERE U.USER_ID = :user_id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $token);
    $stmt->execute();

// 抓出全部且依照順序封裝成一個二維陣列
// PDO::FETCH_ASSOC 回傳一個 index 值是 column name 的陣列
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 將資料型別轉換成陣列
// $result = array('data' => $data);

  // 建立 SQL 語法，取得指定會員ID的回報數總數
  $sql_count = "SELECT COUNT(*) as count FROM DISCUSS_LIKE WHERE USER_ID = :id";
  $statement_count = $pdo->prepare($sql_count);
  $statement_count->bindValue(':id', $token, PDO::PARAM_INT);
  $statement_count->execute();
  $count = $statement_count->fetch(PDO::FETCH_ASSOC)['count'];

// print_r($result);
echo json_encode($result);
?>
