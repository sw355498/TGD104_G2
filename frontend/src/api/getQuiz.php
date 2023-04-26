<?php


include("./getConn_nopush.php");
$questions = [];



// 查询需要的数据
        $sql = "SELECT * FROM GAME
        WHERE GAME_STATUS = 1
        ORDER BY ID DESC";
        $statement = $pdo->prepare($sql);


// 将查询结果转换为数组


$statement-> execute();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $question = array();
    $question['id'] = $row['ID'];
    $question['question'] = $row['QUESTION'];
    $question['options'] = explode(',', $row['OPTION']);
    $question['answer'] = $row['ANSWER'];
    $question['pic'] = $row['PIC'];
    $question['description'] = $row['DESCRIPTION'];
    array_push($questions, $question);
}
   
    
    echo json_encode($questions);
    

// 关闭数据库连接
$pdo = null;


?>













