<?php
    //資料庫連線
    require_once ("getConn_nopush.php");

    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);
    // echo 123;
    $search = htmlspecialchars(isset($data['search']) ? $data['search'] : '');
    
    $sql = "
    select 
        u.ID, u.TITLE as WEBSITE_NM, u.URL as WEBURL, DATE_FORMAT(u.DATE, '%Y-%m-%d') as STA_EDATE, us.STATUS_NAME
    from
        URL as u
    left join URL_STATUS as us
        on u.URL_STATUS = us.id 
    where u.URL_STATUS != 4
    and(
        u.TITLE like '%' :search '%'
        or u.URL like '%' :search '%'
        or us.STATUS_NAME like '%' :search '%'
        or u.DATE like '%' :search '%'
    ) 
    order by
        u.ID desc
    ";
    // print_r($data);

    //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
    $statement = $pdo->prepare($sql);
    $statement ->bindValue(":search", $search);
    $statement->execute();

    //抓出全部且依照順序封裝成一個二維陣列
    //PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    //將資料型別轉換成陣列
    $result = array('data' => $data);
    echo json_encode($result);

?>