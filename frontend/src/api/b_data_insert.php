<?php
    //資料庫連線
    require_once ("getConn_nopush.php");

    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);



    // 過濾輸入的字串
    function filterString($str) {
        $str = trim($str); // 移除字串前後的空白
        $str = htmlspecialchars($str); // 轉換特殊字元
        return $str;
    }

    $whichTable = $data['whichTable'];
    $whichID = $data['whichID'];
    $review = isset($data['review']) ? filterString($data['review']) : '';

    
    switch ($whichTable) {
        //建立SQL語法
        case 'USER':
        case 'staff':
            $nickname = isset($data['nickname']) ? filterString($data['nickname']) : '';
            $mobile = isset($data['mobile']) ? filterString($data['mobile']) : '';
            $birth = isset($data['birth']) ? filterString($data['birth']) : NULL;
            $sql = "UPDATE USER SET 
            NICKNAME = :nickname,
            MOBILE= :mobile,
            BIRTH = :birth
            WHERE ID = :whichID";
            // 執行
            $statement = $pdo->prepare($sql);

            //綁定變數
            $statement ->bindValue(":nickname", $nickname);
            $statement ->bindValue(":mobile", $mobile);
            $statement ->bindValue(":birth", $birth);
            $statement ->bindValue(":whichID", $whichID);
            //執行sql語法
            $statement->execute();

            break;

        case 'URL':
            $sql = "UPDATE `URL` SET 
            URL_STATUS = :review
            WHERE ID = :whichID";
            // 執行
            $statement = $pdo->prepare($sql);

            $statement ->bindValue(":review", $review);
            $statement ->bindValue(":whichID", $whichID);
            //執行sql語法
            $statement->execute();
            break;

        case 'REPLY_REPORT':
            $sql = "UPDATE REPLY_REPORT SET 
            REPORT_STATUS_ID = :review 
            WHERE ID = :whichID";
            $statement = $pdo->prepare($sql);

            $statement ->bindValue(":review", $review);
            $statement ->bindValue(":whichID", $whichID);
            //執行sql語法
            $statement->execute();
            break;

        case 'DISCUSS_REPORT':
            $sql = "UPDATE DISCUSS_REPORT SET 
            REPORT_STATUS_ID = :review
            WHERE ID = :whichID";

            $statement = $pdo->prepare($sql);

            $statement ->bindValue(":review", $review);
            $statement ->bindValue(":whichID", $whichID);
            //執行sql語法
            $statement->execute();
            break;

        case 'MESSAGE_REPORT':
            $sql = "UPDATE MESSAGE_REPORT SET 
            REPORT_STATUS_ID = :review
            WHERE ID = :whichID";

            $statement = $pdo->prepare($sql);

            $statement ->bindValue(":review", $review);
            $statement ->bindValue(":whichID", $whichID);
            //執行sql語法
            $statement->execute();
            break;

        case 'GAME':
            $game_question = isset($data['game_question']) ? filterString($data['game_question']) : '';
            $game_option = isset($data['game_option']) ? filterString($data['game_option']) : '';
            $game_answer = isset($data['game_answer']) ? filterString($data['game_answer']) : '';
            $game_description = isset($data['game_description']) ? filterString($data['game_description']) : '';
            $sql = "UPDATE GAME SET 
            QUESTION = :game_question, 
            `OPTION` = :game_option,
            ANSWER = :game_answer,
            `DESCRIPTION` = :game_description
            WHERE ID = :whichID";

            $statement = $pdo->prepare($sql);

            $statement ->bindValue(":game_question", $game_question);
            $statement ->bindValue(":game_option", $game_option);
            $statement ->bindValue(":game_answer", $game_answer);
            $statement ->bindValue(":game_description", $game_description);
            $statement ->bindValue(":whichID", $whichID);
            //執行sql語法
            $statement->execute();
            break;
        
        case 'chatbot':
            $isbtn = filterString($data['isbtn']);
            $keyword = isset($data['keyword']) ? filterString($data['keyword']) : '';
            $message = isset($data['message']) ? filterString($data['message']) : '';
            $link = isset($data['link']) ? filterString($data['link']) : null;
            $chatbotContent = isset($data['chatbotContent']) ? filterString($data['chatbotContent']) : null;

            $sql = "UPDATE CHATBOT SET 
            BTN = :btn,
            KEYWORD = :keyword, 
            `MESSAGE` = :message,
            LINK = :link,
            CONTENT = :chatbotContent
            WHERE ID = :whichID";


            $statement = $pdo->prepare($sql);

            if(isset($isbtn) && $isbtn){
                $btn = 1;
            } else {
                $btn = 0;
            }

            $statement ->bindValue(":btn", $btn);
            $statement ->bindValue(":keyword", $keyword);
            $statement ->bindValue(":message", $message);
            $statement ->bindValue(":link", $link);
            $statement ->bindValue(":chatbotContent", $chatbotContent);
            $statement ->bindValue(":whichID", $whichID);
            //執行sql語法
            $statement->execute();
            break;

        default:
            echo "資料有誤";
            break;
    };
    
    //抓出全部且依照順序封裝成一個二維陣列
    //PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
    echo "更新資料成功"
?>