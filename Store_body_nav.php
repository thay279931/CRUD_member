<div class="nav nav2">
    <button><a href="Store_index.php">店家首頁</a></button>
 
    <button><a href="writetest.php">上傳頁</a></button>

    <button><a href="update.php">修改頁</a></button>

    <button><a href="delete.php">刪除頁</a></button>

    <button id="goOrder"><a href="Store_Order.php">訂單</a></button>


    <?php if (!empty($_SESSION['store'])) : ?>
        <div class="LOGIN"> <?= $_SESSION['store']['nickname'] ?> </a></div>

        <div class="LOGOUT"><a class="nav-link" href="Store_logout.php">登出</a></div>

        <!-- <div class="LOGIN"><a href="Store_login.php">登入</a></div>

        <div class="LOGOUT"><a class="nav-link" href="#">註冊</a></div> -->

    <?php elseif (!empty($_SESSION['admin'])) : ?>

        <div class="LOGIN"> <?= $_SESSION['admin']['nickname'] ?> </a></div>

        <div class="LOGOUT"><a class="nav-link" href="Store_logout.php">登出</a></div>

    <?php elseif (empty($_SESSION['store']) and empty($_SESSION['admin'])) : ?>

        <div class="LOGIN"><a href="Store_login.php">登入</a></div>

        <div class="LOGOUT"><a class="nav-link" href="#">註冊</a></div>

    <?php endif; ?>



    <button id=""><a href="index.php">會員頁面</a></button>

</div>