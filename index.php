<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--подключили бутстрап-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="js/bootstrap.min.js">
    <!--подключаем онлайн-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>Main</title>


</head>
<body>
<?php include 'myheader.php' ?>
<div class="container">

    <div class="jumbotron">
        <h1 style="color: #1b6d85"> Learn PHP with us</h1>
        <img data-src="holder.js/200x200" class="img-thumbnail" alt="" src="img/main.jpg"
             style="width: 1000px; height: 450px;">
        <p class="lead" style="color: #1b6d85">PHP – это широко используемый язык сценариев общего назначения с открытым
            исходным кодом.

            Говоря проще, PHP это язык программирования, специально разработанный для написания web-приложений
            (сценариев), исполняющихся на Web-сервере.</p>
    </div>
    <div class="row marketing">
        <div class="col-lg-6">
            <h4>Возможности PHP</h4>
            <p>Возможности PHP очень большие. Главным образом, область применения PHP сфокусирована на написание
                скриптов, работающих на стороне сервера; таким образом, PHP способен выполнять всё то, что выполняет
                любая другая программа CGI. Например, обрабатывать данных форм, генерировать динамические страницы,
                отсылать и принимать cookies. Но PHP способен выполнять и множество других задач.</p>

            <h4>Преимущества PHP</h4>
            <p>Главным фактором языка РНР является практичность. РНР должен предоставить программисту средства для
                быстрого и эффективного решения поставленных задач. Практический характер РНР обусловлен пятью важными
                характеристиками: традиционностью, простотой, эффективностью, безопасностью, гибкостью.</p>

        </div>

        <div class="col-lg-6">
            <h4>История развития PHPP</h4>
            <p>Языки программирования бывают двух видов: интерпретируемые и компилируемые. Что касается PHP, то он не
                является ни компилятором, ни интерпретатором. PHP представляет собой нечто среднее, между компилятором и
                интерпретатором. Попробуем в этом разобраться и рассмотрим, как PHP обрабатывает код.</p>

            <h4>Subheading</h4>
            <p>Истоки PHP лежат в старом продукте, имевшем название PHP/FI. PHP/FI был создан Расмусом Лердорфом в 1995
                году и представлял собой набор Perl-скриптов для ведения статистики посещений его резюме.</p>

        </div>


    </div>

</div>
<?php include 'myfooter.php' ?>
</body>