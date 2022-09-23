<?php require __DIR__ . './conect_db.php'; ?>

<?php require __DIR__ . './head_css.php'; ?>

<?php require __DIR__ . './Store_body_nav.php'; ?>


<form name="productUPForm" onsubmit="postDataUP(); return false" enctype="application/x-www-form-urlencoded">
    <input name="product_name" type="text" placeholder="產品名稱">
    <input name="price" type="text" placeholder="價格">
    <input name="product_photo" type="text" placeholder="照片路徑">
    <input name="sid" type="text" placeholder="sid">

    <button type="submit">更新</button>
    <button type="reset">重置</button>
</form>

<script>
    async function postDataUP() {
        const FORM_PRODUCTUP = new FormData(document.productUPForm)

        const res = await fetch('U.php', {

            method: 'POST',
            body: FORM_PRODUCTUP,

        })
        const obj = await res.json();
        console.log(obj);

    }
</script>
</body>

</html>