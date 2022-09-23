<?php
session_start();

$getData = $_POST;

$idin =  $getData['sid'];

if(isset($_SESSION['cart'][$idin])&&$_SESSION['cart'][$idin]>=1){
$_SESSION['cart'][$idin] -= 1;}

if(isset($_SESSION['cart'][$idin])&&$_SESSION['cart'][$idin]==0){
unset($_SESSION['cart'][$idin]);}

$OP = 0;

foreach($_SESSION['cart'] as $i){
    $OP = $OP + $i ;
}

$_SESSION['cartTotal'] = $OP;

echo $OP;

exit;