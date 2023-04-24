<?php
    $fileName = null;
    $file = isset($_FILES["newImage"]) ? $_FILES["newImage"] : null;
    if(!empty($file)){
        $fileName = $file["name"];    //檔案名稱含副檔名        
        $filePath_Temp = $file["tmp_name"];   //Server上的暫存檔路徑含檔名        
        $fileType = $file["type"];    //檔案種類        
        $fileSize = $file["size"];    //檔案尺寸

        // 檢查檔案類型是否為圖片
        if (!in_array($fileType, array('image/jpeg', 'image/png'))) {
            die('只允許上傳 JPG 或 PNG 格式的圖片檔案');
            exit;
        }

        //Web根目錄真實路徑
        $ServerRoot = $_SERVER["DOCUMENT_ROOT"];

        //檔案最終存放位置
        $filePath = $addImageUrl.$save_folder.$fileName;
        // $addImageUrl：所以檔案的共同的相對路徑
        // $save_folder：個別檔案所需要的儲存的資料夾
        // $fileName：檔案存取的名字

    }
?>