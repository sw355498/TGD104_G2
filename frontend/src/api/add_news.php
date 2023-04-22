<?php
    //資料庫連線
    require_once ("./getConn_nopush.php");

    // 設定錯誤報告等級
    error_reporting(E_ERROR);

    //取得上傳的檔案資訊=======================================
    $file = $_FILES["newImage"];
    $fileName = $file["name"];    //檔案名稱含副檔名        
    $filePath_Temp = $file["tmp_name"];   //Server上的暫存檔路徑含檔名        
    $fileType = $file["type"];    //檔案種類        
    $fileSize = $file["size"];    //檔案尺寸



    // 檢查檔案類型是否為圖片
    if (!in_array($fileType, array('image/jpeg', 'image/png'))) {
        die('只允許上傳 JPG 或 PNG 格式的圖片檔案');
        exit;
    }

    //Web根目錄真實路徑
    $ServerRoot = $_SERVER["DOCUMENT_ROOT"];

    //檔案最終存放位置
    $filePath = $addImageUrl."p01_news/".$fileName;
    // "../assets/img/test"：要擺放的資料夾名稱
    // $fileName：檔案存取的名字
    


    // 過濾輸入的字串
    function filterString($str) {
        $str = trim($str); // 移除字串前後的空白
        $str = htmlspecialchars($str); // 轉換特殊字元
        return $str;
    }

    $newsTitle = isset($_POST['newsTitle']) ? filterString($_POST['newsTitle']) : '';
    $newsContent = isset($_POST['newsContent']) ? filterString($_POST['newsContent']) : '';
    $newsTag = isset($_POST['newsTag']) ? filterString($_POST['newsTag']) : '';

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

            //將暫存檔搬移到正確位置
            move_uploaded_file($filePath_Temp, $filePath);
            
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

