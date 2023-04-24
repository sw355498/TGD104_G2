<?php
    // 資料庫連線
    require_once ("./getConn_nopush.php");

    //建立SQL語法
    $sql = "select U.NICKNAME, D.TITLE, D.PIC, D.CONTENT, D.NONNAME, D.CREATE_TIME, DT.CATEGORY
            from DISCUSS D
            JOIN DISCUSS_TYPE DT ON D.DISCUSS_TYPE_ID = DT.ID
            JOIN USER U ON D.USER_ID = U.ID";

    //執行並查詢
    $statement = $pdo->prepare($sql);
    $statement-> execute();

    //抓出全部且依照順序封裝成一個二維陣列
    $data = $statement->fetchAll();

    foreach($data as &$row){
        $row['CONTENT'] = htmlspecialchars_decode($row['CONTENT']);
        $row['CONTENT'] = strip_tags($row['CONTENT']);
    }

    echo json_encode($data);

?>