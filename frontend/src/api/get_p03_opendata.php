<?php

    // 跨域連線
    // 建立一個 Express application 物件
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // 目標API的URL
    $targetUrl = 'https://od.moi.gov.tw/api/v1/rest/datastore/A01010000C-002150-013';

    //判斷所使用的瀏覽器切換不同的User-Agen
    function getUserAgent() {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        
        if (strpos($userAgent, 'Chrome') !== false) {
            // Chrome 瀏覽器
            return 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.9999.999 Safari/537.36';
        } else if (strpos($userAgent, 'Firefox') !== false) {
            // Firefox 瀏覽器
            return 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:99.0) Gecko/20100101 Firefox/99.0';
        } else if (strpos($userAgent, 'Safari') !== false) {
            // Safari 瀏覽器
            return 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.0 Safari/605.1.15';
        } else if (strpos($userAgent, 'Edg') !== false || strpos($userAgent, 'Edge') !== false) {
            // Microsoft Edge 浏览器
            return 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.9999.999 Safari/537.36 Edg/99.0.999.999';
        } else {
            // 默認情況下使用一個常見瀏覽器的 User-Agent
            return 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.9999.999 Safari/537.36';
        }
    }
      
    // 使用獲取的 User-Agent 發送請求
    $options = [
    'http' => [
        'method' => 'GET',
        'header' => getUserAgent(),
    ],
    ];
    
    //發送請求
    $context = stream_context_create($options);
    $response = file_get_contents($targetUrl, false, $context);      
    
      
      
    // 將得到的api回傳給前端
    echo $response;
?>