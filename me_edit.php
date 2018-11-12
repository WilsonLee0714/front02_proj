<?php

$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '資料不足',
];

if(! isset($from_me)){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

// 取得 http request 傳入的 body 資料
$entityBody = file_get_contents('php://input');

// 把文字解析成 PHP 關聯式陣列
$bdata = json_decode($entityBody, true);

$result['data_from'] = $bdata;

$reuire_fields = [
    'password',
    'mobile',
    'address',
    'birthday',
    'nickname',
];

foreach($reuire_fields as $rf){
    if(empty($bdata[$rf])){
        $result['resultCode'] = 405;
        $result['errorMsg'] = $rf. '為必要欄位';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// TODO: 先用 SELECT 檢查密碼是否正確

$sql = "UPDATE `members` SET 
                `mobile`=?,
                `address`=?,
                `birthday`=?,
                `nickname`=? 
                WHERE id=? AND `password`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $bdata['mobile'],
    $bdata['address'],
    $bdata['birthday'],
    $bdata['nickname'],
    $_SESSION['user']['id'],
    sha1($bdata['password']),
]);
if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['resultCode'] = 200;
    $result['errorMsg'] = '';
} else {
    $result['resultCode'] = 406;
    $result['errorMsg'] = '修改沒有成功';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);







