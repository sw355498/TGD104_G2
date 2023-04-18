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
    $sql = "SELECT u.ID, u.ACCOUNT as '帳號', u.NICKNAME as '暱稱', u.CREATE_TIME as '建立日期', us.USER_STATUS_NAME as '狀態', l.LOGIN_TYPE as '登入方式'
        FROM USER as u
            join USER_STATUS as us
                on u.USER_STATUS_ID = us.ID
                    join LOGIN_TYPE as l
                        on u.LOGIN_TYPE_ID = l.ID
                            WHERE u.ACCOUNT_TYPE_ID in ( $inClause ) AND u.USER_STATUS_ID != 3
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
