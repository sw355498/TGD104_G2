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
    LEFT JOIN DISCUSS_STATUS S ON U.DISCUSS_STATUS_ID = S.ID
    WHERE U.USER_ID = :user_id AND U.DISCUSS_STATUS_ID < 4 AND S.ID != 4";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $token);
    $stmt->execute();

// 抓出全部且依照順序封裝成一個二維陣列
// PDO::FETCH_ASSOC 回傳一個 index 值是 column name 的陣列
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 將資料型別轉換成陣列
// $result = array('data' => $data);

  // 建立 SQL 語法，取得每篇文章讚數
  $sql = "SELECT d.*, s.STATUS_NAME, 
        (SELECT COUNT(*) FROM MESSAGE m WHERE m.DISCUSS_ID = d.ID) AS reply_count,
        (SELECT COUNT(*) FROM DISCUSS_LIKE dl WHERE dl.DISCUSS_ID = d.ID) AS likes_count 
        FROM DISCUSS d 
        INNER JOIN DISCUSS_STATUS s ON d.DISCUSS_STATUS_ID = s.ID
        WHERE d.USER_ID = :id AND d.DISCUSS_STATUS_ID < 4 AND s.ID != 4";
  // $sql = "SELECT d.*, s.STATUS_NAME, COUNT(dl.ID) AS likes_count 
  // FROM DISCUSS d 
  // LEFT JOIN DISCUSS_LIKE dl ON dl.DISCUSS_ID = d.ID
  // INNER JOIN DISCUSS_STATUS s ON d.DISCUSS_STATUS_ID = s.ID
  // WHERE d.USER_ID = :id
  // GROUP BY d.ID";
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $token, PDO::PARAM_INT);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);



// print_r($result);
echo json_encode($result);
?>
