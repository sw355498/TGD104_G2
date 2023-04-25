<?php
    // 資料庫連線
    require_once ("./getConn_nopush.php");

    // 取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");

    // 將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    // 定義 Client 端的資料
    $userId = isset($_POST['userId']) ? htmlspecialchars($_POST['userId']) : '';
    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
    // $pic = isset($_POST['pic']) ? htmlspecialchars($_POST['pic']) : '';
    $content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : '';
    $nonname = isset($_POST['nonname']) ? htmlspecialchars($_POST['nonname']) : '';
    $discussTypeId = isset($_POST['discussTypeId']) ? htmlspecialchars($_POST['discussTypeId']) : '';

    // 取得上傳的檔案資訊
    $save_folder = 'p06_discuss/';
    require_once ("./upload_image.php");

    // 建立 SQL
    $sql = "INSERT INTO DISCUSS (USER_ID, TITLE, PIC, CONTENT, NONNAME, CREATE_TIME, DISCUSS_TYPE_ID, DISCUSS_STATUS_ID) VALUES (:USER_ID, :TITLE, :PIC, :CONTENT, :NONNAME, NOW(), :DISCUSS_TYPE_ID, 1)";
    
    // 執行
    $statement = $pdo -> prepare($sql);

    // 綁定參數
    $statement -> bindValue(':USER_ID', $userId);
    $statement -> bindValue(':TITLE', $title);
    $statement -> bindValue(':PIC', $fileName);
    $statement -> bindValue(':CONTENT', $content);
    $statement -> bindValue(':NONNAME', $nonname);
    $statement -> bindValue(':DISCUSS_TYPE_ID', $discussTypeId);

    // 執行 SQL
    $statement -> execute();

    //將暫存檔搬移到正確位置
    move_uploaded_file($filePath_Temp, $filePath);

    // 取出剛剛 INSERT INTO 的那筆資料 ID
    $newId = $pdo -> lastInsertId();

    // 將希望回傳給 Client 端的資料打包成陣列
    $result = array(
        "success" => true,
        "message" => "上傳成功",
        "id" => $newId
    );

    // 將資料封裝成 JSON 形式印出
    echo json_encode($result);

?>