<?php
    
    // 資料庫連線
    require_once ("getConn_nopush.php");


    // 從資料庫中取得問題的資料
    $sql = "SELECT * FROM GAME";

    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);


    //建立SQL語法
    $sql = "SELECT ID, QUESTION AS '問題', `OPTION` AS '選項', ANSWER AS '答案', PIC, `DESCRIPTION` AS '解釋' , CHOOSE AS '被選擇'
        FROM GAME
        WHERE GAME_STATUS = 1
        ORDER BY ID DESC;";


    $statement = $pdo->prepare($sql);
    $statement->execute();

     //抓出全部且依照順序封裝成一個二維陣列
    //PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    //將資料型別轉換成陣列
    $result = array('data' => $data);
    echo json_encode($result);

    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    // //資料庫連線
    // require_once ("getConn_nopush.php");

    // //取得 HTTP POST  Client 端所傳送過來的原始資料
    // $postData = file_get_contents("php://input");
    // //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    // $data = json_decode($postData, true);


    // //建立SQL語法
    // $sql = "SELECT ID, QUESTION AS '問題', ANSWER AS '答案' 
    //     FROM GAME
    //     ORDER BY ID DESC;";

    // $statement = $pdo->prepare($sql);
    // $statement->execute();

    // //抓出全部且依照順序封裝成一個二維陣列
    // //PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
    // $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    // //將資料型別轉換成陣列
    // $result = array('data' => $data);
    // echo json_encode($result);
?>
