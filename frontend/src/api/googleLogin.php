<?php
    //資料庫連線
    require_once ("./getConn_nopush.php");

    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    $userUid = isset($data['userUid']) ? htmlspecialchars($data['userUid']) : '';
    $nickname = isset($data['nickname']) ? htmlspecialchars($data['nickname']) : '';
    $accountTypeID = isset($data['accountTypeID']) ? htmlspecialchars($data['accountTypeID']) : '';

    //建立SQL語法
    $sql = "SELECT * FROM USER WHERE ACCOUNT = :USERUID";
    $statement = $pdo->prepare($sql);
    $statement ->bindValue(":USERUID", $userUid);
    $statement->execute();
    //抓出全部且依照順序封裝成一個二維陣列
    $data = $statement->fetchAll();

    if(count($data) === 0){
        // 建立SQL
        $sql = "INSERT INTO USER (ACCOUNT, NICKNAME, LOGIN_TYPE_ID, ACCOUNT_TYPE_ID, CREATE_TIME) VALUES (:USERUID, :NICKNAME, 3, :ACCOUNT_TYPE_ID, NOW())";

        // 執行
        $statement = $pdo->prepare($sql);

        //綁定變數
        $statement ->bindValue(":USERUID", $userUid);
        $statement ->bindValue(":NICKNAME", $nickname);
        $statement ->bindValue(":ACCOUNT_TYPE_ID", $accountTypeID);
        
        $statement->execute();

        $newId = $pdo->lastInsertId();

        $response = array(
            "success" => true,
            "message" => "帳號註冊成功",
            "id" => $newId
        );
        echo json_encode($response);
    } else {
        $response = array(
            "success" => true,
            "message" => "登入成功",
            "id" => $data[0]['ID']
        );
        echo json_encode($response);
    }

?>
