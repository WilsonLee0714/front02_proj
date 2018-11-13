<?php

if(! isset($from_cart)){
    $result['error'] = '請從 cart.php 訪問';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

if($body===null){
    $result['error'] = '輸入的 json 格式錯誤';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

// 需要兩個參數: sid(必要的參數), all

if(empty($body['sid'])){


    if(empty($body['all'])){ // 沒有 sid 也沒有 all
        $result['error'] = '參數不足';
        $result['resultCode'] = 431;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    } else { // 沒有 sid , 但有 all
        $_SESSION['cart'] = []; // 清除所有項目
        $result['success'] = true;
        $result['resultCode'] = 201;
        $result['cart'] = [];
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
} else {
    // 有 sid , 不判斷 all
    $sid = $body['sid'];

    // 如果沒有該項目
    if(! isset($_SESSION['cart'][$sid])){ // 購物車裡沒有該產品
        $result['error'] = '購物車裡沒有該產品';
        $result['resultCode'] = 432;
        $result['cart'] = $_SESSION['cart'];
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    } else { // 購物車裡有該產品, 做刪除
        unset($_SESSION['cart'][$sid]);
        $result['success'] = true;
        $result['resultCode'] = 200;
        $result['cart'] = $_SESSION['cart'];

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}










