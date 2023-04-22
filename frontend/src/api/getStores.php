<?php 

    require_once("./getConn_nopush.php");
    $data = [];
    //建立SQL語法
    $sql = "select * from STORE where TYPE like :TYPE ";
    
    $statement = $pdo->prepare($sql);
    $statement-> bindValue(':TYPE', '統一超商股份有限公司');
    // $statement-> bindValue(':TYPE', '全家便利商店股份有限公司');
    $statement-> execute();
    // PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($data);

?>