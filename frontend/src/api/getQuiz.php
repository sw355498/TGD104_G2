<?php


include("./getConn_nopush.php");
$data = [];



// 查询需要的数据
        $sql = "SELECT ID, QUESTION AS '問題', `OPTION` AS '選項', ANSWER AS '答案', PIC, `DESCRIPTION` AS '解釋'
        FROM GAME
        WHERE GAME_STATUS = 1
        ORDER BY ID DESC;";
        $statement = $pdo->prepare($sql);


// 将查询结果转换为数组


$statement-> execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);//引用table表頭
    
    echo json_encode($data);

// 关闭数据库连接
$pdo = null;


?>













