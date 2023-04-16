<?php
    // 資料庫連線
    require_once ("./getConn_nopush.php");

    // 取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    // 將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    $account = isset($data['account']) ? htmlspecialchars($data['account']) : '';
    $password = isset($data['password']) ? htmlspecialchars($data['password']) : '';

    if(!empty(trim($account)) && !empty(trim($password))){
        // 建立SQL語法(備忘:這裡要接收USER還是USER_REGISTER)
        $sql = "SELECT * FROM USER_REGISTER WHERE ACCOUNT = :ACCOUNT";
        $statement = $pdo->prepare($sql);
        $statement ->bindValue(":ACCOUNT", $account);
        $statement->execute();
        // 抓出第一筆並封裝成一個陣列
        $data = $statement->fetch();

        if($data && password_verify($password, $data['PASSWORD'])){
            // 登入成功
            echo '登入成功';
        } else {
            // 登入失敗
            echo '帳號或密碼錯誤';
        }
    } else {
        // 資料不完整
        echo '帳號與密碼尚未輸入';
    }
?>