<?php
    //資料庫連線
    require_once ("getConn_nopush.php");

    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    $whichTable = $data['whichTable'];
    $updateStatusID = $data['updateStatusID'];
    $updateID = $data['updateID'];

    //建立SQL語法
    switch ($whichTable) {
        case 'USER':
        case 'staff':
            $sql = "UPDATE USER SET USER_STATUS_ID = :updateStatusID WHERE ID = :updateID";
            break;

        case 'DISCUSS':
            $sql = "UPDATE DISCUSS SET DISCUSS_STATUS_ID = :updateStatusID WHERE ID = :updateID";
            break;

        case 'URL':
            $sql = "UPDATE URL SET URL_STATUS = :updateStatusID WHERE ID = :updateID";
            break;

        case 'REPLY_REPORT':
            $sql = "UPDATE REPLY_REPORT SET REPORT_STATUS = :updateStatusID WHERE ID = :updateID";
            break;

        case 'DISCUSS_REPORT':
            $sql = "UPDATE DISCUSS_REPORT SET REPORT_STATUS = :updateStatusID WHERE ID = :updateID";
            break;

        case 'MESSAGE_REPORT':
            $sql = "UPDATE MESSAGE_REPORT SET REPORT_STATUS = :updateStatusID WHERE ID = :updateID";
            break;
        
        case 'NEWS':
            $sql = "UPDATE NEWS SET NEWS_STATUS = :updateStatusID WHERE ID = :updateID";
            break; 

        case 'GAME':
            $sql = "UPDATE GAME SET GAME_STATUS = :updateStatusID WHERE ID = :updateID";
            break;

        default:
            echo "資料有誤";
            break;
    };

    $statement = $pdo->prepare($sql);

    //綁定變數
    $statement ->bindValue(":updateStatusID", $updateStatusID);
    $statement ->bindValue(":updateID", $updateID);

    $statement->execute();

    echo "資料更新成功";
?>
