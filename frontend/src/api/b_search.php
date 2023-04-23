<?php
    //資料庫連線
    require_once ("getConn_nopush.php");

    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    $search = htmlspecialchars(isset($data['search']) ? $data['search'] : '');

    $whichTable = $data['whichTable'];
    
    switch ($whichTable) {
        //建立SQL語法
        case 'USER':
            $sql = "SELECT u.ID, u.ACCOUNT AS '帳號', u.NICKNAME AS '暱稱', u.CREATE_TIME AS '建立日期', us.USER_STATUS_NAME AS '狀態', l.LOGIN_TYPE AS '登入方式'
            FROM USER AS u
            JOIN USER_STATUS AS us ON u.USER_STATUS_ID = us.ID
            JOIN LOGIN_TYPE AS l ON u.LOGIN_TYPE_ID = l.ID
            WHERE 
                u.ACCOUNT_TYPE_ID = 1
                AND u.USER_STATUS_ID != 3
                AND (
                    u.ID like '%' :search '%'
                    OR u.ACCOUNT like '%' :search '%'
                    OR  u.NICKNAME like '%' :search '%'
                    OR u.CREATE_TIME like '%' :search '%'
                    OR us.USER_STATUS_NAME like '%' :search '%'
                    OR l.LOGIN_TYPE like '%' :search '%'
                )
            ORDER BY u.ID DESC;";
            break;

        case 'DISCUSS':
            $sql = "SELECT d.ID, d.TITLE AS '文章標題',  dt.CATEGORY AS '文章分類', u.ACCOUNT AS '作者', d.CREATE_TIME AS '建立日期', ds.STATUS_NAME AS '狀態'
            FROM DISCUSS AS d
            JOIN USER AS u ON d.USER_ID = u.ID
            JOIN DISCUSS_TYPE AS dt ON d.DISCUSS_TYPE_ID = dt.ID
            JOIN DISCUSS_STATUS AS ds ON d.DISCUSS_STATUS_ID = ds.ID
            WHERE d.DISCUSS_STATUS_ID NOT IN (2 ,4)
                AND (
                    d.ID like '%' :search '%'
                    OR d.TITLE  like '%' :search '%'
                    OR dt.CATEGORY like '%' :search '%'
                    OR u.ACCOUNT like  '%' :search '%'
                )
            ORDER BY d.ID DESC;";
            break;

        case 'URL':
            $sql = "SELECT ur.ID, ur.TITLE AS '網站名稱', ur.URL AS '網址', u.ACCOUNT AS '回報人', DATE_FORMAT(ur.DATE, '%Y-%m-%d') AS '回報日期', us.STATUS_NAME AS '回報狀態'
            FROM URL AS ur
            JOIN USER AS u ON ur.USER_ID = u.ID
            JOIN URL_STATUS AS us ON ur.URL_STATUS = us.ID
            WHERE ur.TITLE like '%' :search '%'
                OR ur.URL like '%' :search '%'
                OR u.ACCOUNT like '%' :search '%'
                OR us.STATUS_NAME like '%' :search '%'
                OR ur.DATE like '%' :search '%'
            ORDER BY u.ID DESC;";
            break;
            
        case 'REPLY_REPORT':
            $sql = "SELECT r.ID, r.CONTENT AS '檢舉對象', rr.REASON AS '檢舉原因', u.ACCOUNT AS '檢舉人', rr.TIME AS '檢舉日期', rs.STATUS_NAME AS '審核狀況'
            FROM REPLY_REPORT AS rr
            JOIN USER AS u ON rr.USER_ID = u.ID
            JOIN REPLY AS r ON rr.REPLY_ID = r.ID
            JOIN REPORT_STATUS AS rs ON rr.REPORT_STATUS_ID = rs.ID
            WHERE r.ID like '%' :search '%'
                OR r.CONTENT like '%' :search '%'
                OR rr.REASON like '%' :search '%'
                OR u.ACCOUNT like '%' :search '%'
                OR rs.STATUS_NAME like '%' :search '%'
            ORDER BY r.ID DESC;";
            break;

        case 'DISCUSS_REPORT':
            $sql = "SELECT d.ID, d.TITLE AS '檢舉對象', dr.REASON AS '檢舉原因', u.ACCOUNT AS '檢舉人', dr.TIME AS '檢舉日期', rs.STATUS_NAME AS '審核狀況'
            FROM DISCUSS_REPORT AS dr
            JOIN USER AS u ON dr.USER_ID = u.ID
            JOIN DISCUSS AS d ON dr.DISCUSS_ID = d.ID
            JOIN REPORT_STATUS AS rs ON dr.REPORT_STATUS_ID = rs.ID
            WHERE d.TITLE like '%' :search '%'
                OR dr.REASON like '%' :search '%'
                OR u.ACCOUNT like '%' :search '%'
                OR rs.STATUS_NAME like '%' :search '%'
            ORDER BY d.ID DESC;";
            break;

        case 'MESSAGE_REPORT':
            $sql = "SELECT m.ID, m.CONTENT AS '檢舉對象', mr.REASON AS '檢舉原因', u.ACCOUNT AS '檢舉人', mr.TIME AS '檢舉日期', rs.STATUS_NAME AS '審核狀況'
            FROM MESSAGE_REPORT AS mr
            JOIN USER AS u ON mr.USER_ID = u.ID
            JOIN MESSAGE AS m ON mr.MESSAGE_ID = m.ID
            JOIN REPORT_STATUS AS rs ON mr.REPORT_STATUS_ID = rs.ID
            WHERE m.CONTENT like '%' :search '%'
                OR mr.REASON like '%' :search '%'
                OR u.ACCOUNT like '%' :search '%'
                OR rs.STATUS_NAME like '%' :search '%'
            ORDER BY m.ID DESC;";
            break;
        
        case 'NEWS':
            $sql = "SELECT ID, NEWS_TITLE AS '標題', NEWS_CATEGORY AS '分類', NEWS_CONTENT AS '內容', DATE_FORMAT(CREATE_DATE, '%Y/%m/%d') AS '建立日期' 
            FROM NEWS
            WHERE NEWS_STATUS = 1
            AND (
                ID like '%' :search '%'
                OR NEWS_TITLE like '%' :search '%'
                OR NEWS_CATEGORY like '%' :search '%'
                OR NEWS_CONTENT like '%' :search '%'
            )
            ORDER BY ID DESC;";
            break; 

        case 'GAME':
            $sql = "SELECT ID, QUESTION AS '問題', ANSWER AS '答案' 
            FROM GAME
            WHERE GAME_STATUS = 1
            AND (
                ID like '%' :search '%'
                OR QUESTION like '%' :search '%'
                OR ANSWER like '%' :search '%'
            )
            ORDER BY ID DESC;";
            break;

        case 'staff':
            $sql = "SELECT u.ID, u.ACCOUNT AS '帳號', u.NICKNAME AS '暱稱', u.CREATE_TIME AS '建立日期', us.USER_STATUS_NAME AS '狀態', l.LOGIN_TYPE AS '登入方式'
            FROM USER AS u
            JOIN USER_STATUS AS us ON u.USER_STATUS_ID = us.ID
            JOIN LOGIN_TYPE AS l ON u.LOGIN_TYPE_ID = l.ID
            WHERE 
                u.ACCOUNT_TYPE_ID IN (2, 3)
                AND u.USER_STATUS_ID != 3
                AND (
                    u.ID like '%' :search '%'
                    OR u.ACCOUNT like '%' :search '%'
                    OR  u.NICKNAME like '%' :search '%'
                    OR u.CREATE_TIME like '%' :search '%'
                    OR us.USER_STATUS_NAME like '%' :search '%'
                    OR l.LOGIN_TYPE like '%' :search '%'
                )
            ORDER BY u.ID DESC;";
            break;
        default:
            echo "資料有誤";
            break;
    };
    
    

    //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
    $statement = $pdo->prepare($sql);
    $statement ->bindValue(":search", $search);
    $statement->execute();

    //抓出全部且依照順序封裝成一個二維陣列
    //PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    //將資料型別轉換成陣列
    $result = array('data' => $data);
    echo json_encode($result);

?>