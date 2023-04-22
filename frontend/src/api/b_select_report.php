<?php
    //資料庫連線
    require_once ("getConn_nopush.php");

    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);
    $whichTable = $data['whichTable'];

    //建立SQL語法
    switch ($whichTable) {
        case 'DISCUSS_REPORT':
            $sql = "SELECT dr.ID, d.TITLE AS '檢舉對象', dr.REASON AS '檢舉原因', u.ACCOUNT AS '檢舉人', dr.TIME AS '檢舉日期', rs.STATUS_NAME AS '審核狀況'
                FROM DISCUSS_REPORT AS dr
                JOIN USER AS u ON dr.USER_ID = u.ID
                JOIN DISCUSS AS d ON dr.DISCUSS_ID = d.ID
                JOIN REPORT_STATUS AS rs ON dr.REPORT_STATUS_ID = rs.ID;";
            break;

        case 'MESSAGE_REPORT':
            $sql = "SELECT mr.ID, m.CONTENT AS '檢舉對象', mr.REASON AS '檢舉原因', u.ACCOUNT AS '檢舉人', mr.TIME AS '檢舉日期', rs.STATUS_NAME AS '審核狀況'
                FROM MESSAGE_REPORT AS mr
                JOIN USER AS u ON mr.USER_ID = u.ID
                JOIN MESSAGE AS m ON mr.MESSAGE_ID = m.ID
                JOIN REPORT_STATUS AS rs ON mr.REPORT_STATUS_ID = rs.ID;";
            break;

        case 'REPLY_REPORT':
            $sql = "SELECT rr.ID, r.CONTENT AS '檢舉對象', rr.REASON AS '檢舉原因', u.ACCOUNT AS '檢舉人', rr.TIME AS '檢舉日期', rs.STATUS_NAME AS '審核狀況'
                FROM REPLY_REPORT AS rr
                JOIN USER AS u ON rr.USER_ID = u.ID
                JOIN REPLY AS r ON rr.REPLY_ID = r.ID
                JOIN REPORT_STATUS AS rs ON rr.REPORT_STATUS_ID = rs.ID;";
            break;

        default:
            echo "資料有誤";
            break;
    };

    $statement = $pdo->prepare($sql);
    $statement->execute();

    //抓出全部且依照順序封裝成一個二維陣列
    //PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    //將資料型別轉換成陣列
    $result = array('data' => $data);
    echo json_encode($result);
?>
