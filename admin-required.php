<?php
if(! isset($_SESSION)){
    session_start();
}

if(empty($_SESSION['admin'])){
    header('Location: Store_login.php');
    exit;
}