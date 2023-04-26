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

    $account = isset($data['account']) ? filterString($data['account']) : '';
    $oldPassword = isset($data['oldPassword']) ? filterString($data['oldPassword']) : '';
    $newPassword = isset($data['newPassword']) ? filterString($data['newPassword']) : '';
    //建立SQL語法
    
    if(!empty(trim($account)) && !empty(trim($oldPassword)) && !empty($newPassword)){ 
        $sql = "SELECT * FROM USER WHERE ACCOUNT = :account;";

        $statement = $pdo->prepare($sql);
        $statement ->bindValue(":account", $account);
        $statement->execute();
        //抓出全部且依照順序封裝成一個二維陣列
        $data = $statement->fetchAll();

        if($data && password_verify($oldPassword, $data[0]['PASSWORD'])){
            // 密碼配對成功
            // 建立SQL
            $sql = "UPDATE USER SET PASSWORD = :PWD WHERE ACCOUNT = :account";

            //密碼加密
            $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);

            // 執行
            $statement = $pdo->prepare($sql);

            //綁定變數
            $statement ->bindValue(":account", $account);
            $statement ->bindValue(":PWD", $newPassword);
            //執行sql語法
            $statement->execute();

            echo '密碼修改成功';
            exit;
        } else {
            echo '密碼輸入錯誤';
            exit;
        }
    } else {
        if (empty($oldPassword)) {
            echo '原密碼尚未輸入,';
        }
        if (empty($newPassword)) {
            echo '新密碼尚未輸入,';
        }
    }
?>
