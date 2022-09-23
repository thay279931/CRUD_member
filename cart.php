<?php
session_start();

$getData = $_POST;

$idin =  $getData['sid'];

if(!isset($_SESSION['cart'][$idin])||$_SESSION['cart'][$idin]==""){
$_SESSION['cart'][$idin] = 1;}

else{
    $_SESSION['cart'][$idin] +=1;
}

$OP = 0;

foreach($_SESSION['cart'] as $i){
    $OP = $OP +$i;
}

$_SESSION['cartTotal'] = $OP;

echo $OP;

// $_SESSION['user'] = [
//     'account' => $check['account'],
//     'nickname' => $check['name'],
//     'sid'=>$check['sid'],

// array_push(,);




//echo json_encode($state->fetchAll(),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

exit;