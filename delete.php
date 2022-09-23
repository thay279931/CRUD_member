<?php require __DIR__ . './conect_db.php'; ?>


<?php require __DIR__ . './head_css.php'; ?>

<?php require __DIR__ . './Store_body_nav.php'; ?>

<form name="productDForm" onsubmit="postData(); return false" enctype="application/x-www-form-urlencoded">
    <input name="sid" type="text" placeholder="商品SID">
    <button type="submit">刪除</button>
    <button type="reset">重置</button>
</form>


<script>
    async function postData() {
        const FORM_PRODUCTD = new FormData(document.productDForm)

        const res = await fetch('D.php', {

            method: 'POST',
            body: FORM_PRODUCTD,

        })
        const obj = await res.json();
        console.log(obj);

    }
</script>
</body>

</html>