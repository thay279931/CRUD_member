<?php require __DIR__ . './conect_db.php'; ?>

<?php require __DIR__ . './head_css.php'; ?>

<?php require __DIR__ . './Store_body_nav.php'; ?>


<form name="productForm" onsubmit="postData(); return false" enctype="application/x-www-form-urlencoded">
    <input name="product_name" type="text" placeholder="產品名稱">
    <input name="price" type="text" placeholder="價格">
    <input name="product_photo" type="text" placeholder="照片路徑">

    <button type="submit">送出</button>
    <button type="reset">重置</button>
</form>


<script>
    async function postData() {
        const FORM_PRODUCT = new FormData(document.productForm)

        const res = await fetch('W.php', {

            method: 'POST',
            body: FORM_PRODUCT,

        })
        const obj = await res.json();
        console.log(obj);

    }
</script>
</body>

</html>