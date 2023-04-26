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
    $sql = "SELECT NC.NEWS_ID, NC.CREATE_TIME, N.NEWS_TITLE, N.NEWS_STATUS
            FROM NEWS_COLLECT NC
            JOIN NEWS N ON NC.NEWS_ID = N.ID
            WHERE NC.USER_ID = :user_id
            UNION ALL
            SELECT DC.DISCUSS_ID, DC.CREATE_TIME, D.TITLE AS DISCUSS_TITLE, DS.STATUS_NAME
            FROM DISCUSS_COLLECT DC
            JOIN DISCUSS D ON DC.DISCUSS_ID = D.ID
            JOIN DISCUSS_STATUS DS ON D.DISCUSS_STATUS_ID = DS.ID
            WHERE DC.USER_ID = :user_id";

    
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $token);
$stmt->execute();

// 抓出全部且依照順序封裝成一個二維陣列
// PDO::FETCH_ASSOC 回傳一個 index 值是 column name 的陣列
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 將資料型別轉換成陣列
// $result = array('data' => $data);

// print_r($result);
echo json_encode($result);
?>
