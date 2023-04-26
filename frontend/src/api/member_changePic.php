<?php
   // 資料庫連線
   require_once ("./getConn_nopush.php");


    // 取得 HTTP POST  Client 端所傳送過來的原始資料
    // $postData = file_get_contents("php://input");
    // // 將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    // $data = json_decode($postData, true);

    // print_r($data);
    
   // 取得傳入的 token (此處假設 token 內容為會員 ID)
   $userId = isset($_POST['userId']) ? $_POST['userId'] : '';

   
    // 取得上傳的檔案資訊
    $save_folder = 'p08_user/';
    require_once ("./upload_image.php");

    // 建立 SQL
    $sql = "UPDATE USER SET PIC = :pic WHERE ID = :id";
    
    // 執行
    $statement = $pdo -> prepare($sql);

    // 綁定參數
    $statement -> bindValue(':id', $userId);
    $statement -> bindValue(':pic', $fileName);

    // 執行 SQL
    $statement -> execute();

    //將暫存檔搬移到正確位置
    move_uploaded_file($filePath_Temp, $filePath);

    $newId = $pdo -> lastInsertId();

    // 將希望回傳給 Client 端的資料打包成陣列
    $result = array(
        "success" => true,
        "message" => "上傳成功",
        "id" => $userId,
    );

    // 將資料封裝成 JSON 形式印出
    echo json_encode($result);
?>

