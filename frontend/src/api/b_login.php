<?php
    // 資料庫連線
    require_once ("./getConn_nopush.php");

    // 取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    // 將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    //取得上傳的檔案資訊=======================================
    $save_folder = "p07_demo/p07_demoGame/";
    require_once ("./upload_image.php");

    $statement ->bindValue(":gameAnswer", $gameAnswer);
    
    if(!empty(trim($account)) && !empty(trim($password))){
        // 建立SQL語法
        $sql = "SELECT * FROM USER WHERE ACCOUNT = :ACCOUNT AND ACCOUNT_TYPE_ID IN (2, 3) AND USER_STATUS_ID = 1 ";
        $statement = $pdo->prepare($sql);
        $statement ->bindValue(":ACCOUNT", $account);
        $statement->execute();
        // 抓出第一筆並封裝成一個陣列
        $data = $statement->fetch();

        if($data && password_verify($password, $data['PASSWORD'])){
            // 登入成功
            $response = array(
                "success" => true,
                "message" => "登入成功",
                "id" => $data['ID'],
                "account" => $data['ACCOUNT'],
                "nickname" => $data['NICKNAME'],
                "pic" => $data['PIC'],
                "account_type_id" => $data['ACCOUNT_TYPE_ID'],
            );
            echo json_encode($response);
        } else {
            // 登入失敗
            echo '帳號或密碼錯誤';
            exit();
        }
    } else {
        // 資料不完整
        if (empty($account)) {
            $response['errorAccount'] = '帳號尚未輸入';
        }
        if (empty($password)) {
            $response['errorPassword'] = '密碼尚未輸入';
        }
        echo json_encode($response);
    }
?>