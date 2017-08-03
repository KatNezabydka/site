<?php

session_start();

//Проверка - есть ли у нас логин? - зарегистрировался человек
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    $bgcolors = ['white', 'silver', 'wheat', 'honeydew', 'beige'];

    ?>

    <!DOCTYPE html>
    <html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--подключили бутстрап-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="js/bootstrap.min.js">
    <!--подключаем онлайн-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>Home page</title>
    <style>
        .fon {
            background-color: <?php if (!empty($_GET)) {
                $_SESSION['bgcolor'] =
                    $_GET['bgcolor'];
                echo $_SESSION['bgcolor'];
            } else echo $_SESSION['bgcolor']; ?>
        }
    </style>
</head>
<body>
<?php include 'myheader.php' ?>
<div class="container">
    <div class="row">
        <div class="col-md-offset-8 col-md-4 col-xs-12">
        <form action="home_page.php">
            <select name="bgcolor"  class=" input-sm" id="bgcolor">
                <?php foreach ($bgcolors as $color) : ?>
                    <option value="<?= $color ?>" <?php if (isset($_SESSION['bgcolor']) && $color == $_SESSION['bgcolor'])
                        echo 'selected'; ?>><?= $color ?> </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary">Выбрать фон</button>
        </form>

    </div>


        <div class="col-md-offset-1 col-md-10 col-xs-12 fon">
            <h1> Урок № 1 - Самые основы</h1>

            <p class="lead">Авторы (участники forum.php.su): valenok, Champion</p>
            <p class="lead">Обсуждение: Обсуждение уроков.</p>


            <p class="lead"> Переменные выполняют работу - хранение данных в оперативной памяти, а за хорошую работу
                надо платить. Именно поэтому переменная представлена в виде знака доллара и названия переменной. К
                примеру: $variable . </p>

            <p class="lead">Сама по себе переменная существовать не может. Ей нужны её данные так-же, как нам
                холодильник. При
                помощи присваивания мы кладём в переменную данные. Присваивание выглядит следующим образом: $var =
                что-то; </p>

            <p class="lead">Правильное имя переменной должно начинаться с буквы или символа подчеркивания с последующими
                в любом
                количестве буквами, цифрами или символами подчеркивания. </p>

            <p class="lead">Так же как и наш холодильник, переменная хранит еду.
                Еда бывает разных типов - напитки, гарниры, салаты, печеное, молочные продукты и т.д.
                Данные тоже бывают разных типов.. целые числа, дробные числа, наборы букв, наборы других данных и еще
                несколько. </p>
            <h2>Целое число ( Integer )<h2>

                    <p class="lead">Как вам известно, числа бывают положительные, отрицательные и в разных системах
                        исчисления. Чаще всего подразумевается что целое это число из множества Z = {..., -2, -1, 0, 1,
                        2, ...}.
                        Предел совершенства наших компьютеров позволяет использовать в качестве целого числа, числа из
                        диапазона Signed: −2,147,483,648 to +2,147,483,647.</p>
                    <h2>Дробные числа ( Float )<h2>
                    <p class="lead">Числа с плавающей точкой (они же числа двойной точности или действительные числа)
                        отличная кандидатура на хранение к примеру результата деления 7 на 3
                        Как правило диапазон возможностей здесь немного шире как правило, ~1.8e308 с точностью около 14 десятичных цифр (64-битная система)</p>
                    <p class="lead"> Оставайтесь с нами и узнаете много интересного </p>


        </div>
    </div>
</div>
<?php include 'myfooter.php' ?>
</body>
    <?php
} else {
    header('Location: login.php');
}
?>