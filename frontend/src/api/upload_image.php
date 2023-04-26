<?php
    $fileName = null;
    $file = isset($_FILES["newImage"]) ? $_FILES["newImage"] : null;
    if(!empty($file)){

        $fileName = $file["name"];    //檔案名稱含副檔名        
        $filePath_Temp = $file["tmp_name"];   //Server上的暫存檔路徑含檔名        
        $fileType = $file["type"];    //檔案種類        
        $fileSize = $file["size"];    //檔案尺寸

        // 檢查上傳的檔案類型和大小
        $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');
        $maxSize = 1024 * 1024; // 1MB
        if (!in_array($fileType, $allowedTypes)) {
            echo('只允許上傳 jpg 或 phg 或 gif 格式的圖片檔案');
            exit;
        }
        if($fileSize >= $maxSize){
            echo('檔案大小不得超過1MB');
            exit;
        }

        //Web根目錄真實路徑
        $ServerRoot = $_SERVER["DOCUMENT_ROOT"];

        //檔案最終存放位置(本地開發)
        $filePath = $addImageUrl.$save_folder.$fileName;
        //檔案最終存放位置(Server端)
        // $filePath = $addImageUrl.$fileName;
        
        // $addImageUrl：所以檔案的共同的相對路徑
        // $save_folder：個別檔案所需要的儲存的資料夾
        // $fileName：檔案存取的名字

    }
?>