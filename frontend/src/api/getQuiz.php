<?php


include("./getConn_nopush.php");

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// 查询需要的数据
$sql = "SELECT ID, QUESTION, OPTION, ANSWER, PIC, DESCRIPTION FROM GAME";
$result = $conn->query($sql);

// 将查询结果转换为数组
$data = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
}

// 将数组转换为JSON格式
$jsonData = json_encode($data);

// 将JSON数据发送到前端
header('Content-Type: application/json');
echo $jsonData;

// 关闭数据库连接
$conn->close();
?>













?>