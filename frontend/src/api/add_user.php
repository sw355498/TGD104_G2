<?php
    //資料庫連線
    require_once ("./getConn_nopush.php");


    //取得 HTTP POST  Client 端所傳送過來的原始資料
    $postData = file_get_contents("php://input");
    //將 JSON 格式的資料轉換成 PHP 陣列或物件形式的函式
    $data = json_decode($postData, true);

    $account = isset($data['account']) ? htmlspecialchars($data['account']) : '';
    $password = isset($data['password']) ? htmlspecialchars($data['password']) : '';
    $nickname = isset($data['nickname']) ? htmlspecialchars($data['nickname']) : '';

    if(!empty(trim($account)) && !empty(trim($password))){
        //建立SQL語法
        $sql = "SELECT * FROM USER WHERE ACCOUNT = :ACCOUNT";
        $statement = $pdo->prepare($sql);
        $statement ->bindValue(":ACCOUNT", $account);
        $statement->execute();
        //抓出全部且依照順序封裝成一個二維陣列
        $data = $statement->fetchAll();

        if(count($data) === 0){
            // 建立SQL
            $sql = "INSERT INTO USER (ACCOUNT, PASSWORD, NICKNAME, LOGIN_TYPE_ID, ACCOUNT_TYPE_ID, CREATE_TIME) VALUES (:ACCOUNT, :PWD, :NICKNAME, 1, 1, NOW())
            ";

            //密碼加密
            $password = password_hash($password, PASSWORD_BCRYPT);

            // 執行
            $statement = $pdo->prepare($sql);

            //綁定變數
            $statement ->bindValue(":ACCOUNT", $account);
            $statement ->bindValue(":PWD", $password);
            $statement ->bindValue(":NICKNAME", $nickname);

            //執行sql語法
            $statement->execute();

            echo '帳號註冊成功';
        } else {
            echo '此帳號已被註冊';
        }
    } else {
        if (empty($account) && empty($password)) {
            echo '帳號與密碼尚未輸入';
        }
        if (empty($account) && !empty($password)) {
            echo '帳號尚未輸入';
        }
        if (!empty($account) && empty($password)) {
            echo '密碼尚未輸入';
        }
    }

    /*
        筆記區域
    
        file_get_contents("php://input")
        file_get_contents() 函式是 PHP 的標準函式，它可以讀取指定檔案的內容並以並以字串形式返回(JSON 或 者 XML)。
        php://input 是一個 PHP 的 I/O 資源識別符，它代表著 Client 端所傳送過來的 HTTP POST 請求的內容
    
        json_decode($postData, true)
        json_decode() 函式是 PHP 的標準函式，它可以解析 JSON 格式的字串並將其轉換為 PHP 陣列或物件。
        true 則是一個選項，表示將返回值轉換為關聯陣列形式。如果將此選項設為 false 或省略，則返回值將是一個物件形式。
    
        htmlspecialchars
        PHP 函數，用於將特殊字符轉換為 HTML 實體，以避免這些字符被誤解為 HTML 標記，從而防止 XSS（跨站腳本）攻擊。
        htmlspecialchars 函數將特殊字符轉換為 HTML 實體，以避免這種情況發生。
        例如，將 < 轉換為 &lt;，將 > 轉換為 &gt;，將 & 轉換為 &amp; 等。轉換後的文本將顯示在網頁上，而不會被解釋為 HTML 標記。
    
        isset()
        isset() 函數可以用於檢查變數、陣列中的元素或物件中的屬性是否存在，並且不為 null。如果變數存在並且不為 null，isset 函數將返回 true，否則返回 false。
    
        trim() 
        trim() 函式用於刪除字串開頭和結尾的空格或其他指定字符。

        empty() 
        PHP 內建的函數，用於判斷一個變數是否為空或者為 0

        password_hash()
        密碼雜湊函式，用於將原始的明文密碼轉換成一個不可逆的加密值。
        使用 password_hash 函式時，會自動生成一個隨機的 salt（鹽值），並將 salt 與明文密碼結合後進行雜湊，最終得到一個加密後的雜湊值。在驗證使用者輸入的密碼時，只需將使用者輸入的明文密碼與資料庫中存儲的雜湊值進行比較即可。因為每次生成的 salt 都不同，即使同一個密碼被多次雜湊，其結果也會不同，這樣可以提高密碼的安全性。
        *備註：存取的資料庫長度不得小於255並且建議使用"utf8mb4_unicode_ci" 編碼
    
        -> 符號
        在php中 -> 符號 相當於JavaScrip 中的 . 
    
        prepare()
        PDO 物件的方法，用於準備一個 SQL 語法，並創建一個 PDO 語法 物件，以供後續執行。
        可以接受一個包含 SQL 語法的字符串作為參數。
        使用 prepare() 方法可以防止 SQL 注入攻擊。SQL 注入攻擊是一種常見的 Web 安全問題，攻擊者利用 Web 應用程式中的漏洞，向數據庫中插入惡意的 SQL 語法，從而獲取敏感信息或破壞數據庫
    
        bindValue()
        PDO 中的一個函式，將一個參數值綁定到一個參數名或問號占位符上，以供後續執行的 SQL 語句中使用。
        這種方式可以防止 SQL 注入攻擊，同時還可以避免在 SQL 語句中使用引號和逸出符號所帶來的困擾。
    
        fetchAll()
        PDO 中的一個函式，用於從查詢結果集中檢索所有行
    
        execute()
        執行預先編譯語句
    */
?>
