<?php
    //資料庫連線
    require_once ("./getConn_nopush.php");

    $newsTitle = isset($_POST['newsTitle']) ? filterString($_POST['newsTitle']) : '';
    $newsContent = isset($_POST['newsContent']) ? filterString($_POST['newsContent']) : '';
    $newsTag = isset($_POST['newsTag']) ? filterString($_POST['newsTag']) : '';

    //取得上傳的檔案資訊=======================================
    $save_folder = "p01_news/";
    require_once ("./upload_image.php");

    // 過濾輸入的字串
    function filterString($str) {
        $str = trim($str); // 移除字串前後的空白
        $str = htmlspecialchars($str); // 轉換特殊字元
        return $str;
    }


    if(!empty($newsTitle) && !empty($newsContent)){

            // 建立SQL
            $sql = "INSERT INTO NEWS (NEWS_TITLE, NEWS_CONTENT, CREATE_DATE, NEWS_PIC, NEWS_CATEGORY) VALUES (:newsTitle, :newsContent, NOW(), '$fileName', :newsTag)
            ";

            // 執行
            $statement = $pdo->prepare($sql);

            //綁定變數
            $statement ->bindValue(":newsTitle", $newsTitle);
            $statement ->bindValue(":newsContent", $newsContent);
            $statement ->bindValue(":newsTag", $newsTag);
            //執行sql語法
            $statement->execute();

            //確認有值才會執行以下的檔案搬遷
            if(!empty($file)){
                //將暫存檔搬移到正確位置
                move_uploaded_file($filePath_Temp, $filePath);
            }
            
            echo '最新消息新增成功';
    } else {
        if (empty($newsTitle)) {
            echo '標題尚未輸入,';
        }
        if (empty($newsContent)) {
            echo '內容未輸入,';
        }
    }
    
?>

