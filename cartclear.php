<?php
session_start();

$getData = $_POST;

$idin =  $getData['sid'];

unset($_SESSION['cart'][$idin]);

$OP = 0;

foreach($_SESSION['cart'] as $i){
    $OP = $OP + $i ;
}

$_SESSION['cartTotal'] = $OP;

echo $OP;

exit;