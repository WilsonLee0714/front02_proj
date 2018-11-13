<?php
require __DIR__.'/__connect_db.php';

$sql = "SELECT * FROM `categories`";
$stmt = $pdo->query($sql);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$m_data = [];

foreach($data as $v){
    // 如果是第一層選單
    if($v['parent_sid']==0){
        $m_data[$v['sid']] = $v;
    }
}


foreach($data as $v){
    // 如果是第二層選單
    // 如果這項資料的 parent_sid 是 m_data 的 key, 表示它是第二層
    if(isset($m_data[$v['parent_sid']])){

        // 1. 先取得第一層的 key: $v['parent_sid']
        // 2. 再取得該分類的上一層(第一層): $m_data[$v['parent_sid']]
        // 3. 將該分類 push 到上一層底下的 children
        $m_data[$v['parent_sid']]['children'][] = $v;
    }
}


$result =[
    'success'=>true,
    'data'=>$m_data,
];

echo json_encode($result, JSON_UNESCAPED_UNICODE);













