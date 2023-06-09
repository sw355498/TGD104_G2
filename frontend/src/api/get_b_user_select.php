<?php
    //資料庫連線
    require_once ("./getConn_nopush.php");


    $account = htmlspecialchars(isset($_POST['account']) ? $_POST['account'] : '');
    $data = [];
    if(trim($account)){
        //建立SQL語法
        $sql = "SELECT * FROM member WHERE Account like '%' :account '%'";

        //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
        $statement = $pdo->prepare($sql);
        $statement -> bindValue(":account", $account);
        $statement-> execute();
        //抓出全部且依照順序封裝成一個二維陣列
        $data = $statement->fetchAll();

    }
    echo json_encode($data);
?>