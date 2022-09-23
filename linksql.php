<?php

require __DIR__. '/conect_db.php';

$sql = "SELECT * FROM product";

//$sql = "SELECT * FROM product WHERE store_sid LIKE ?"; 限定店家
// $state= $pdo->prepare($sql);
$state= $pdo->query($sql);
// $state->execute([    
//     $_SESSION['user']['sid']
// ]);

// print_r($state->fetchAll());
// print_r($state->fetch());

echo json_encode($state->fetchAll(),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

?>
