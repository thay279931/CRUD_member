<?php

require __DIR__ . '/conect_db.php';

// $_POST['sid'];
// $_POST['product_name'];
// $_POST['store_sid'];
// $_POST['price'];
// $_POST['product_photo'];

$postData = $_POST;

// $sql = "INSERT INTO `product`(
//     `product_name`,
//     `store_sid`,
//     `price`,
//     `product_photo`
//     )
// VALUES (?,?,?,?)";

$sql = "UPDATE `product` SET 
    `product_name`=?,
    `price`=?,
    `product_photo`=?
    WHERE `product`.`sid`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $postData['product_name'],
    $postData['price'],
    $postData['product_photo'],
    Intval($postData['sid']),
]);

echo $stmt->rowCount();
