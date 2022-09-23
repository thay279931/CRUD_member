<?php 

require __DIR__ . '/conect_db.php';

// $_POST['product_name'];
// $_POST['store_sid'];
// $_POST['price'];
// $_POST['product_photo'];

$postData = $_POST;

$sql = "DELETE FROM `product` WHERE `product`.`SID` = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $postData['sid']
]);

echo $stmt->rowCount();

