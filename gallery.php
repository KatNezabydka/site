<?php

session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {

    $format = ["jpg", "png", "bmp", "gif", "jpeg"];
    @mkdir("gallery", 0777);
// Каталог, в который мы будем принимать файл:
    $uploadDir = './img/gallery/';

    if (!empty($_POST) === true) {
        $arr = explode(".", $_FILES['image']['name']);
        if (in_array($arr[count($arr) - 1], $format)) {// проверяем формат файлов, соответствует нашему списку
            $uploadFile = $uploadDir . basename($_FILES['image']['name']);// создаем путь к новому файлу

// Копируем файл из каталога для временного хранения файлов:
            if (copy($_FILES['image']['tmp_name'], $uploadFile)) {
                echo "<h3 >Файл успешно загружен на сервер</h3>";
            }
        } else {
            echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>";
            exit;
        }

    }

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
    <title>Gallery</title>

</head>
<body>
<?php include 'myheader.php' ?>
<div class="container">
    <div class="bs-example">
        <div class="row">
            <br>

            <?php if (array_diff(scandir($uploadDir), array('..', '.')) != false): ?>
                <?php foreach (array_diff(scandir($uploadDir), array('..', '.')) as $picture): ?>
                    <div class="col-xs-6 col-md-3">
                        <a href="<?php echo $uploadDir . $picture; ?>" class="thumbnail">
                            <img data-src="holder.js/100%x180" alt="100%x180"
                                 style="height: 280px; width: 100%; display: block;"
                                 src="<?php echo $uploadDir . $picture; ?>">
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

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
