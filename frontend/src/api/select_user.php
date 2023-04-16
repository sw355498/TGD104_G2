<?php
        //資料庫連線
        require_once ("getConn_nopush.php");


        //建立SQL語法
        $sql = "SELECT u.ID, u.ACCOUNT as '帳號', u.NICKNAME as '暱稱', u.CREATE_TIME as '建立日期', us.USER_STATUS_NAME as '登入方式', l.LOGIN_TYPE as '狀態'
            FROM USER as u
                join USER_STATUS as us
                    on u.USER_STATUS_ID = us.ID
                        join LOGIN_TYPE as l
                            on u.LOGIN_TYPE_ID = l.ID
                                WHERE u.ACCOUNT_TYPE_ID = 1;";

        //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
        $statement = $pdo->query($sql);

        //抓出全部且依照順序封裝成一個二維陣列
        //PDO::FETCH_ASSOC 回傳一個index值是column name 的陣列
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        //將資料型別轉換成陣列
        $result = array('data' => $data);
        echo json_encode($data);
?>