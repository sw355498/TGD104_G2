<?php


//MySQL相關資訊
$db_host = "127.0.0.1";
$db_user = "root";
$db_pass = "password";
$db_select = "TGD104G2";

//建立資料庫連線物件
$dsn = "mysql:host=".$db_host.";dbname=".$db_select.";charset=utf8";

//建立PDO物件，並放入指定的相關資料
$pdo = new PDO($dsn, $db_user, $db_pass);

//---------------------------------------------------

// 建立一個 Express application 物件
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// 查询需要的数据
$sql = "SELECT ID, QUESTION, `OPTION`, ANSWER, PIC, `DESCRIPTION` FROM GAME";
$result = $pdo->query($sql);

// 将查询结果转换为数组
$data = array();
if ($result->rowCount > 0) {
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
  }
}

// 将数组转换为JSON格式
$jsonData = json_encode($data);

// 将JSON数据发送到前端
header('Content-Type: application/json');
echo $jsonData;

// 关闭数据库连接
$pdo = null;


?>













