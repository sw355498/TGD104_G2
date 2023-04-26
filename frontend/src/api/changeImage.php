<?php
    //資料庫連線
    require_once ("getConn_nopush.php");

    function filterString($str) {
        $str = trim($str); // 移除字串前後的空白
        $str = htmlspecialchars($str); // 轉換特殊字元
        return $str;
    }

    $account = isset($_POST['account']) ? filterString($_POST['account']) : '';
    //取得上傳的檔案資訊=======================================
    $save_folder = 'p08_user/';
    require_once ("./upload_image.php");
    if(!empty($file)){
        $sql = "UPDATE USER SET PIC = '$fileName' WHERE ACCOUNT = :account";
        // 執行
        $statement = $pdo->prepare($sql);

        //綁定變數
        $statement ->bindValue(":account", $account);
        //執行sql語法
        $statement->execute();

        move_uploaded_file($filePath_Temp, $filePath);
        echo '圖片更新成功';
    } else {
        echo '圖片更新失敗';
    }

?>
