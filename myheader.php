<div class="container">
    <div class="breadcrumb navbar navbar-default">
        <ol class="breadcrumb navbar-right">
        <!--Если на кнопку Войти нажимает пользователь, который находится в системе - нужно проигнорить-->
            <?php if (isset($_SESSION['email']) && isset($_SESSION['password']))echo "<li>Привет, " . $_SESSION['name'] . "</li>";
            else echo "<li><a href='registration.php'>Регистрация</a></li>"; ?>

            <?php if (isset($_SESSION['email']) && isset($_SESSION['password']))echo "<li><a href='logout.php'>Выйти</a></li>";
            else echo "<li><a href='login.php'>Войти</a></li>"; ?>

<!--            <li><a href="--><?php //if (isset($_SESSION['email']) && isset($_SESSION['password']))echo "#"; else echo "registration.php";?><!-- ">Регистрация</a></li>-->
        </ol>

        <div class="navbar-header">
            <a class="navbar-brand" href="index.php" style="color: #1b6d85">Learn php</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Главная</a></li>
<?php //if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) echo "<div class='alert alert-danger col-md-offset-3 col-md-6 col-xs-12'><strong>Пожалуйста авторизуйтесь!</strong></div>"; ?>
                <li><a href="home_page.php">Домашняя страничка</a></li>
                <li><a href="contactForm.php">Контакты</a></li>
                <li><a href="gallery.php">Фото галерея</a></li>
                <li><a href="comment.php">Оставить отзыв</a></li>

            </ul>
        </div>
    </div>
</div>
<!--class="active" - чтобы она стала активной-->