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
    $filePath = "../assets/img/p06_discuss/".$fileName;
    // "../assets/img/test"：要擺放的資料夾名稱
    // $fileName：檔案存取的名字
    


    // 過濾輸入的字串
    function filterString($str) {
        $str = trim($str); // 移除字串前後的空白
        $str = htmlspecialchars($str); // 轉換特殊字元
        return $str;
    }

    $newTitle = isset($_POST['newTitle']) ? filterString($_POST['newTitle']) : '';
    $newContent = isset($_POST['newContent']) ? filterString($_POST['newContent']) : '';
    $newAnswer = isset($_POST['newAnswer']) ? filterString($_POST['newAnswer']) : '';
    $newExplain = isset($_POST['newExplain']) ? filterString($_POST['newExplain']) : '';

    if(!empty($newTitle) && !empty($newContent) && !empty($newAnswer) && !empty($newExplain)){

            // 建立SQL
            $sql = "INSERT INTO GAME (QUESTION, `OPTION`, ANSWER, PIC, DESCRIPTION) VALUES (:newTitle, :newContent, :newAnswer, '$fileName', :newExplain)
            ";

            // 執行
            $statement = $pdo->prepare($sql);

            //綁定變數
            $statement ->bindValue(":newTitle", $newTitle);
            $statement ->bindValue(":newContent", $newContent);
            $statement ->bindValue(":newAnswer", $newAnswer);
            $statement ->bindValue(":newExplain", $newExplain);
            //執行sql語法
            $statement->execute();

            //將暫存檔搬移到正確位置
            move_uploaded_file($filePath_Temp, $filePath);
            
            echo '題目新增成功';
    } else {
        if (empty($newTitle)) {
            echo '題目尚未輸入,';
        }
        if (empty($newContent)) {
            echo '選項未輸入,';
        }
        if (empty($newAnswer)) {
            echo '解答尚未輸入,';
        }
        if (empty($newExplain)) {
            echo '解釋尚未輸入,';
        }
    }
    
?>

