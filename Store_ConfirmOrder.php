<?php
require __DIR__ . '/conect_db.php';


// $_SESSION['store']['sid'];
//FD.append("confirm", 1);   0取消  1接單 2完成  $postData['confirm']
//FD.append("whoCanceled", 0);  0會員  1店家     $postData['whoCanceled']

$postData = $_POST;

if ($postData['confirm'] == 1) {
    $sql = "UPDATE `orders` SET 
    `shop_order_status`= 1,
    `recept_time` =NOW()
    WHERE `orders`.`sid`=?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $postData['order_sid'],
    ]);

    echo $stmt->rowCount();
    exit;
} else if ($postData['confirm'] == 0) {
    $sql = "UPDATE `orders` SET 
    `shop_order_status`= 0,
    `order_finish`= 1,
    `complete_time` =NOW()
    WHERE `orders`.`sid`=?";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $postData['order_sid'],
    ]);

    echo $stmt->rowCount();
    exit;
}else if ($postData['confirm'] == 2) {
    $sql = "UPDATE `orders` SET 
    `shop_order_status`= 1,
    `order_finish`= 1,
    `complete_time` =NOW()
    WHERE `orders`.`sid`=?";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $postData['order_sid'],
    ]);

    echo $stmt->rowCount();
    exit;
}
