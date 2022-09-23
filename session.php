<?php
//要放在最前面
session_start();//啟用


if(! isset($_SESSION['user'])){
        $_SESSION['user']=0;
}

$_SESSION['一二三']="\<h2\>Hello\</h2\>";

$_SESSION['user']++;
echo $_SESSION['user'];
?>