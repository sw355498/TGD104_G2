<?php
    //資料庫連線
    require_once ("getConn_nopush.php");

    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    $whichTable = $data['whichTable'];
    $whichID = $data['whichID'];
    
    switch ($whichTable) {
        //建立SQL語法
        case 'USER':
        case 'staff':
            $sql = "SELECT u.ID, u.ACCOUNT, u.NICKNAME, u.PIC, u.MOBILE , DATE_FORMAT(u.BIRTH, '%Y-%m-%d') AS BIRTH,u.ACCOUNT_TYPE_ID, u.CREATE_TIME, us.USER_STATUS_NAME, l.LOGIN_TYPE
            FROM USER AS u
            JOIN USER_STATUS AS us ON u.USER_STATUS_ID = us.ID
            JOIN LOGIN_TYPE AS l ON u.LOGIN_TYPE_ID = l.ID
            WHERE u.ID = :whichID";
            break;

        case 'DISCUSS':
            $sql = "SELECT d.ID, d.TITLE, dt.CATEGORY , u.ACCOUNT, d.CONTENT, d.CREATE_TIME, ds.STATUS_NAME
            FROM DISCUSS AS d
            JOIN USER AS u ON d.USER_ID = u.ID
            JOIN DISCUSS_TYPE AS dt ON d.DISCUSS_TYPE_ID = dt.ID
            JOIN DISCUSS_STATUS AS ds ON d.DISCUSS_STATUS_ID = ds.ID
            WHERE d.ID = :whichID";
            break;

        case 'URL':
            $sql = "SELECT ur.ID, ur.TITLE, ur.URL, u.ACCOUNT, ur.DATE, DATE_FORMAT(ur.DATE, '%Y-%m-%d') AS DATE, ur.URL_STATUS, us.STATUS_NAME
            FROM `URL` AS ur
            LEFT JOIN USER AS u ON ur.USER_ID = u.ID
            JOIN URL_STATUS AS us ON ur.URL_STATUS = us.ID
            WHERE ur.ID = :whichID";
            break;

        case 'REPLY_REPORT':
            $sql = "SELECT r.ID, r.CONTENT AS `TARGET`, rr.REASON, u.ACCOUNT, rr.TIME, rs.STATUS_NAME
            FROM REPLY_REPORT AS rr
            JOIN USER AS u ON rr.USER_ID = u.ID
            JOIN REPLY AS r ON rr.REPLY_ID = r.ID
            JOIN REPORT_STATUS AS rs ON rr.REPORT_STATUS_ID = rs.ID
            WHERE r.ID = :whichID";
            break;

        case 'DISCUSS_REPORT':
            $sql = "SELECT d.ID, d.TITLE AS `TARGET`, dr.REASON, u.ACCOUNT, dr.TIME, rs.STATUS_NAME
            FROM DISCUSS_REPORT AS dr
            JOIN USER AS u ON dr.USER_ID = u.ID
            JOIN DISCUSS AS d ON dr.DISCUSS_ID = d.ID
            JOIN REPORT_STATUS AS rs ON dr.REPORT_STATUS_ID = rs.ID
            WHERE d.ID = :whichID";
            break;

        case 'MESSAGE_REPORT':
            $sql = "SELECT m.ID, m.CONTENT AS `TARGET`, mr.REASON, u.ACCOUNT, mr.TIME, rs.STATUS_NAME
            FROM MESSAGE_REPORT AS mr
            JOIN USER AS u ON mr.USER_ID = u.ID
            JOIN MESSAGE AS m ON mr.MESSAGE_ID = m.ID
            JOIN REPORT_STATUS AS rs ON mr.REPORT_STATUS_ID = rs.ID
            WHERE m.ID = :whichID";
            break;
        
        case 'NEWS':
            $sql = "SELECT ID, NEWS_TITLE, NEWS_CATEGORY, NEWS_PIC, NEWS_CONTENT, DATE_FORMAT(CREATE_DATE, '%Y-%m-%d') AS CREATE_DATE
            FROM NEWS
            WHERE ID = :whichID";
            break; 

        case 'GAME':
            $sql = "SELECT ID, QUESTION, PIC, `OPTION`, ANSWER, `DESCRIPTION`
            FROM GAME
            WHERE ID = :whichID";
            break;

        case 'chatbot':
            $sql = "SELECT ID, BTN, KEYWORD, MESSAGE, CONTENT, LINK 
            FROM CHATBOT 
            WHERE ID = :whichID";
            break;
        
        default:
            echo "資料有誤";
            break;
    };

    

    //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
    $statement = $pdo->prepare($sql);
    $statement ->bindValue(":whichID", $whichID);
    $statement->execute();

    //抓出全部且依照順序封裝成一個二維陣列
    //PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    // 當查詢時的是討論版時會將內容的HTML實體字符轉換回原始字符
    if($whichTable == 'DISCUSS'){
        foreach($data as &$row){
            $row['CONTENT'] = htmlspecialchars_decode($row['CONTENT']);
            $row['CONTENT'] = strip_tags($row['CONTENT']);
        }
    }

    echo json_encode($data);

?>