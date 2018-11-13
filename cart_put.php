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

// 需要兩個參數: sid(必要的參數), qty

if(empty($body['sid'])){
    $result['error'] = '沒有產品 sid';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$sid = $body['sid'];
$qty = empty($body['qty']) ? 0 : intval($body['qty']);

// 之前沒有設定的話, 就回報錯誤
if(! isset($_SESSION['cart'][$sid])){
    $result['error'] = '購物車裡沒有該產品';
    $result['resultCode'] = 420;
    $result['cart'] = $_SESSION['cart'];
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

if($qty <= 0){
    unset($_SESSION['cart'][$sid]); // 刪除項目
} else {
    $_SESSION['cart'][$sid] = $qty; // 變更數量
}


$result['success'] = true;
$result['resultCode'] = 200;
$result['cart'] = $_SESSION['cart'];

echo json_encode($result, JSON_UNESCAPED_UNICODE);








