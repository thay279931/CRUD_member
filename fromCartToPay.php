<?php

if (!isset($_SESSION)) {
    session_start();
}
$db_host = 'localhost';
$db_name = 'test1';
$db_user = 'root';
$db_pass = 'root';

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$output = [
    'success' => false,
    'error' => '',
    'code' => 0
];

//登入檢查
// code 0 OK 1 沒登入
if (!isset($_SESSION['user']['email'])) {

    $output['error'] = '請先登入';
    $output['code'] = 1;
    echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}


//※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※
//※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※
//※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※

$totalPrice = $_POST['price'];

$Msid =  $_SESSION['user']['sid'];
$shopSid = $_SESSION['cartShop'];

$sql = "INSERT INTO `orders`(
    `member_sid`,
    `shop_sid`, 
    `shop_order_status`,
    `order_finish`,
    `order_time`,

    `order_total`,
    `memo`,
    `coupon_sid`,
    `sale`,
    `review`,
    `chat_sid`
    ) VALUES (
    $Msid,
    $shopSid,
    0,
    0,
    NOW(),

    $totalPrice,
    'memo',
    20,
    $totalPrice,
    0,
    1)";

// 用mysqli_query方法執行(sql語法)將結果存在變數中
$result = mysqli_query($link, $sql);

// 如果有異動到資料庫數量(更新資料庫)
if (mysqli_affected_rows($link) > 0) {
    // 如果有一筆以上代表有更新
    // mysqli_insert_id可以抓到第一筆的id
    $new_id = mysqli_insert_id($link);

    $output['sid'] = $new_id;}

//     echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
// } elseif (mysqli_affected_rows($link) == 0) {
//     echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
// } else {
//     echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
// }
mysqli_close($link);



require __DIR__ . '/conect_db.php';

$cartlist = $_SESSION['cart'];

foreach($cartlist as $i => $j){

    $getPrice = "SELECT `SID`,`price` FROM `product` WHERE SID = $i";

    $gettedprice = $pdo->query($getPrice)->fetch();


$sqlDetail =  "INSERT INTO `order_detail`(
    `order_sid`,
    `product_sid`,
    `product_price`,
    `amount`
)
VALUES(
    ?,
    ?,
    ?,
    ?
)";

$stmt = $pdo->prepare($sqlDetail);

$stmt->execute([$output['sid'],$i,$gettedprice['price'],$j]);

}
unset($_SESSION['cart']);
unset($_SESSION['cartShop']);
unset($_SESSION['cartTotal']);

if(!empty($stmt->rowCount())){
    echo $stmt->rowCount();
}


//SELECT `SID`,`price` FROM `product` WHERE SID = 1100;