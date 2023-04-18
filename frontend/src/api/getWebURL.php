<?php 

    require_once("./getConn_nopush.php");
    $data = [];
    //建立SQL語法
    // $sql = "select * from URL";
    $sql = "
    select 
        u.ID, u.TITLE as WEBSITE_NM, u.URL as WEBURL, DATE_FORMAT(u.DATE, '%Y/%m/%d') as STA_EDATE, us.STATUS_NAME
    from
        URL as u
        join URL_STATUS as us
        on u.URL_STATUS = us.id 
    order by
        u.ID desc
    "
    // orderby id新增順序
        ; 
    $statement = $pdo->prepare($sql);
    $statement-> execute();
    // PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($data);

?>