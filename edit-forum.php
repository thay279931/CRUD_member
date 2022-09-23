<?php require __DIR__ . './conect_db.php';
$chat = isset($_GET['chat']) ? intval($_GET['chat']) : 0;
if (empty($chat)) {
    header('Location: list-forum.php');
    exit;
}

$sql = "SELECT * FROM chat WHERE chat=$chat";
$r = $pdo->query($sql)->fetch();
if (empty($r)) {
    header('Location: list-forum.php');
    exit;
}
?>
<?php require __DIR__ . './head_css.php'; ?>

<?php require __DIR__ . './body_nav.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">修改資料</h5>
                    <form name="form1" onsubmit="checkForm(); return false;" novalidate>
                        <input type="hidden" name="chat" value="<?= $r['chat'] ?>">
                        <div class="mb-3">
                            <label for="author" class="form-label">author</label>
                            <input type="text" class="form-control" id="author" name="author" required value="<?= htmlentities($r['author']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="time" class="form-label">time</label>
                            <input type="text" class="form-control" id="time" name="time" value="<?= $r['time'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="sid_title" class="form-label">sid_title</label>
                            <input type="text" class="form-control" id="sid_title" name="sid_title" value="<?= $r['sid_title'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= $r['title'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">content</label>
                            <input type="text" class="form-control" id="content" name="content" value="<?= $r['content'] ?>" pattern="09\d{2}-?\d{3}-?\d{3}">
                        </div>
                        <div class="mb-3">
                            <label for="reply_sid" class="form-label">reply_sid</label>
                            <input type="text" class="form-control" id="reply_sid" name="reply_sid" value="<?= $r['reply_sid'] ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    function checkForm() {
        // document.form1.email.value

        const fd = new FormData(document.form1);

        for (let k of fd.keys()) {
            console.log(`${k}: ${fd.get(k)}`);
        }
        // TODO: 檢查欄位資料

        fetch('edit-forum-api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            console.log(obj);
            if (!obj.success) {
                alert(obj.error);
            } else {
                alert('修改成功')
                location.href = 'list-forum.php';
            }
        })
    }
</script>
<?php require __DIR__ . './foot.php'; ?>