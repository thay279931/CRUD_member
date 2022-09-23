<div class="nav">

    <div>購物車</div>

    <div id="cartcount">0</div>



    <button><a href="index.php">首頁</a></button>
    <?php if (!empty($_SESSION['admin'])) : ?>

<button><a href="list.php">管理者會員列表</a></button>
<button><a href="list-forum.php">管理者論壇列表</a></button>
<?php else : ?>
<?php endif; ?>

    <button id="goCart"><a href="cartPage.php">購物車</a></button>

    <button id="goOrder"><a href="Order.php">訂單</a></button>

    <button><a href="list-user.php">會員修改</a></button>


    <?php if (empty($_SESSION['user'])) : ?>

        <div class="LOGIN"><a href="login.php">登入</a></div>


        <div class="LOGOUT"><a class="nav-link" href="register.php">註冊</a></div>

    <?php else : ?>

        <div class="LOGIN"><?= $_SESSION['user']['nickname'] ?></a></div>


        <div class="LOGOUT"><a class="nav-link" href="logout.php">登出</a></div>

    <?php endif; ?>


    <button id=""><a href="Store_index.php">店家頁面</a></button>

</div>

<script>

    let cartCountBoxNav = document.querySelector("#cartcount");

    function a() {
        fetch("getCart.php")
            .then(r => r.json())
            .then(res => {

                cartCountBoxNav.innerText = res;
            })
    }
    a();

    let cartLink = document.querySelector("#goCart");

    cartLink.addEventListener("click", (evt) => {
        evt.preventDefault();
        fetch("checkcart.php").then(r => r.json()).then(res => {
            if (res == 0) {
                alert("購物車為空!!");
                evt.preventDefault();
            } else if (res == 1) {
                location.href = "cartPage.php";
            }
        })

    })
</script>