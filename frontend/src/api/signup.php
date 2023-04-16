<?php
    //資料庫連線
    require_once ("./getConn_nopush.php");


    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    $account = isset($data['account']) ? htmlspecialchars($data['account']) : '';
    $password = isset($data['password']) ? htmlspecialchars($data['password']) : '';
    $nickname = isset($data['nickname']) ? htmlspecialchars($data['nickname']) : '';
    $accountTypeID = isset($data['accountTypeID']) ? htmlspecialchars($data['accountTypeID']) : '';

    if(!empty(trim($account)) && !empty(trim($password))){
        //建立SQL語法
        $sql = "SELECT * FROM USER WHERE ACCOUNT = :ACCOUNT";
        $statement = $pdo->prepare($sql);
        $statement ->bindValue(":ACCOUNT", $account);
        $statement->execute();
        //抓出全部且依照順序封裝成一個二維陣列
        $data = $statement->fetchAll();

        if(count($data) === 0){
            // 建立SQL(備忘:這裡欄位需要跟丞哥討論)
            $sql = "INSERT INTO USER_REGISTER (ACCOUNT, PASSWORD, NICKNAME, LOGIN_TYPE_ID, CREATE_TIME) 
            VALUES (:ACCOUNT, :PWD, :NICKNAME, 1, NOW())
            ";

            //密碼加密
            $password = password_hash($password, PASSWORD_BCRYPT);

            // 執行
            $statement = $pdo->prepare($sql);

            //綁定變數
            $statement ->bindValue(":ACCOUNT", $account);
            $statement ->bindValue(":PWD", $password);
            $statement ->bindValue(":NICKNAME", $nickname);
            // $statement ->bindValue(":ACCOUNT_TYPE_ID", $accountTypeID);
            //執行sql語法
            $statement->execute();

            echo '帳號註冊成功';
        } else {
            echo '此帳號已被註冊';
        }
    } else {
        if (empty($account) && empty($password)) {
            echo '帳號與密碼尚未輸入';
        }
        if (empty($account) && !empty($password)) {
            echo '帳號尚未輸入';
        }
        if (!empty($account) && empty($password)) {
            echo '密碼尚未輸入';
        }
    }

?>
