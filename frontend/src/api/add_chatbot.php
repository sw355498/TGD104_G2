<?php
    //資料庫連線
    require_once ("./getConn_nopush.php");


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

    $isbtn = filterString($data['isbtn']);
    $keyword = isset($data['keyword']) ? filterString($data['keyword']) : '';
    $message = isset($data['message']) ? filterString($data['message']) : null;
    $link = isset($data['link']) ? filterString($data['link']) : null;
    $chatbotContent = isset($data['chatbotContent']) ? filterString($data['chatbotContent']) : null;

    if(!empty($keyword) && !empty($message)){
        // 建立SQL
        $sql = "INSERT INTO CHATBOT (BTN, KEYWORD, `MESSAGE`, LINK, CONTENT, `STATUS`) VALUES (:btn, :keyword, :message, :link, :chatbotContent, 1)
        ";

            // 執行
            $statement = $pdo->prepare($sql);

            if(isset($isbtn) && $isbtn){
                $btn = 1;
            } else {
                $btn = 0;
            }

            //綁定變數
            $statement ->bindValue(":btn", $btn);
            $statement ->bindValue(":keyword", $keyword);
            $statement ->bindValue(":message", $message);
            $statement ->bindValue(":chatbotContent", $chatbotContent);
            $statement ->bindValue(":link", $link);
            //執行sql語法
            $statement->execute();

            echo '新增成功';
    } else {
        if (empty($keyword)) {
            echo '關鍵字尚未輸入,';
        }
        if (empty($message)) {
            echo '訊息尚未輸入,';
        }
    }

?>
