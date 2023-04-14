<?php 

    include("./getConn_nopush.php");
    $data = [];
    //建立SQL語法
    // $sql = "select * from URL";
    $sql = "select u.TITLE, u.URL, SUBSTRING(u.DATE, 1, 11) as DATE, us.STATUS_NAME
    from
     URL as u
     join URL_STATUS as us
      on u.URL_STATUS = us.id" ; 
    $statement = $pdo->prepare($sql);
    // $statement->bindValue(':keyword', '%'.$keyword.'%');
    $statement-> execute();
    // PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($data);

?>