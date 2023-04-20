<?php
    //資料庫連線
    require_once ("getConn_nopush.php");

    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);
    //從 $data 中取得 whereVariable 變數的值
    $whereVariable = $data['whereVariable'];

    // 將陣列轉換為字串，並用逗號分隔每個值
    $inClause = implode(',', $whereVariable);

    //建立SQL語法
    $sql = "SELECT u.ID, u.ACCOUNT AS '帳號', u.NICKNAME AS '暱稱', u.CREATE_TIME AS '建立日期', us.USER_STATUS_NAME AS '狀態', l.LOGIN_TYPE AS '登入方式'
        FROM USER AS u
            JOIN USER_STATUS AS us
            ON u.USER_STATUS_ID = us.ID
                    JOIN LOGIN_TYPE AS l
                        ON u.LOGIN_TYPE_ID = l.ID
                            WHERE u.ACCOUNT_TYPE_ID IN ( $inClause ) AND u.USER_STATUS_ID != 3
                                ORDER BY u.ID DESC;";

    $statement = $pdo->prepare($sql);
    $statement->execute();

    //抓出全部且依照順序封裝成一個二維陣列
    //PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    //將資料型別轉換成陣列
    $result = array('data' => $data);
    echo json_encode($result);
?>
