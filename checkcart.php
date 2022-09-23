<?php

session_start();

if (!isset($_SESSION['cart'])||empty($_SESSION['cart'])) {
    $res = 0;
echo $res;
} 
else{
    $res = 1;
    echo $res ;
}