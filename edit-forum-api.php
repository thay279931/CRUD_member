<?php
require __DIR__ . '/conect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST, // 除錯用的
];

if (empty($_POST['author'])) {
    $output['error'] = '參數不足';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($_POST['reply_sid'])) {
    $_POST['reply_sid'] = null;
}



// TODO: 檢查欄位資料

$sql = "UPDATE `chat` SET 
`author`=?,
`time`=?,
`sid_title`=?,
`title`=?,
`content`=?,
`reply_sid`=?
WHERE chat=?";

$stmt = $pdo->prepare($sql);


try {
    $stmt->execute([
        $_POST['author'],
        $_POST['time'],
        $_POST['sid_title'],
        $_POST['title'],
        $_POST['content'],
        $_POST['reply_sid'],
        $_POST['chat']
    ]);
} catch (PDOException $ex) {
    $output['error'] = $ex->getMessage();
}


if ($stmt->rowCount()) {
    $output['success'] = true;
} else {
    if (empty($output['error']))
        $output['error'] = '資料沒有修改';
}
echo json_encode($output, JSON_UNESCAPED_UNICODE);
