<?php 

require __DIR__ . '/conect_db.php';

// $_POST['product_name'];
// $_POST['store_sid'];
// $_POST['price'];
// $_POST['product_photo'];

$postData = $_POST;

$sql = "INSERT INTO `product`(
    `product_name`,
    `store_sid`,
    `price`,
    `product_photo`
    )
VALUES (?,?,?,?)";


$stmt = $pdo->prepare($sql);

$stmt->execute([
    $postData['product_name'],
    $_SESSION['user']['sid'],
    $postData['price'],
    $postData['product_photo'],
]);

echo $stmt->rowCount();

