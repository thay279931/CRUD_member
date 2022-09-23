<?php 
require __DIR__ . '/conect_db.php'; 

$chat = isset($_GET['chat']) ? intval($_GET['chat']) : 0;

$sql = "DELETE FROM chat WHERE chat={$chat}";

$pdo->query($sql);

$come_from = 'list-forum.php';

if(! empty($_SERVER['HTTP_REFERER'])){
    $come_from = $_SERVER['HTTP_REFERER'];
}
header("Location: {$come_from}");