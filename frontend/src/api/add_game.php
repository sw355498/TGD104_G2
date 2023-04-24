<?php
    //資料庫連線
    require_once ("./getConn_nopush.php");

    $gameTitle = isset($_POST['gameTitle']) ? filterString($_POST['gameTitle']) : '';
    $gameContent = isset($_POST['gameContent']) ? filterString($_POST['gameContent']) : '';
    $gameAnswer = isset($_POST['gameAnswer']) ? filterString($_POST['gameAnswer']) : '';
    $gameExplain = isset($_POST['gameExplain']) ? filterString($_POST['gameExplain']) : '';

    //取得上傳的檔案資訊=======================================
    $save_folder = "p07_demo/p07_demoGame/";
    require_once ("./upload_image.php");
    
    // 過濾輸入的字串
    function filterString($str) {
        $str = trim($str); // 移除字串前後的空白
        $str = htmlspecialchars($str); // 轉換特殊字元
        return $str;
    }

    if(!empty($gameTitle) && !empty($gameContent) && !empty($gameAnswer) && !empty($gameExplain)){

            // 建立SQL
            $sql = "INSERT INTO GAME (QUESTION, `OPTION`, ANSWER, PIC, DESCRIPTION) VALUES (:gameTitle, :gameContent, :gameAnswer, '$fileName', :gameExplain)
            ";

            // 執行
            $statement = $pdo->prepare($sql);

            //綁定變數
            $statement ->bindValue(":gameTitle", $gameTitle);
            $statement ->bindValue(":gameContent", $gameContent);
            $statement ->bindValue(":gameAnswer", $gameAnswer);
            $statement ->bindValue(":gameExplain", $gameExplain);
         
            //執行sql語法
            $statement->execute();
            
            if(!empty($file)){
                //將暫存檔搬移到正確位置
                move_uploaded_file($filePath_Temp, $filePath);
            }


            echo '題目新增成功';
    } else {
        if (empty($gameTitle)) {
            echo '題目尚未輸入,';
        }
        if (empty($gameContent)) {
            echo '選項未輸入,';
        }
        if (empty($gameAnswer)) {
            echo '解答尚未輸入,';
        }
        if (empty($gameExplain)) {
            echo '解釋尚未輸入,';
        }
    }
    
?>

