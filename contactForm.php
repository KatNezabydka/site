<?php


$header = "Content-Type: text/plain; charset=utf-8\r\n";
$header .= "From: ";

session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {

    if (!empty($_POST) === true) {

        $errors = [];

        $name = strip_tags($_POST['name']);
        $email = strip_tags($_POST['email']);
        $subject = strip_tags($_POST['subject']);
        $message = strip_tags($_POST['message']);

        if (empty($name) === true || empty($email) === true || empty($subject) === true || empty($message) === true) {
            $errors[] = "Каждое поле должно быть заполнено";
        } else {

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Введите действительный email адрес";
            }
            //регулярные выражения
            if (preg_match('/[^(\w) | (\x7F-\xFF) | (\s)]/', $name)) {
                $errors[] = "Имя может содержать только буквенные символы, знаки подчеркивания и пробелы";
            }

            if (empty($errors) === true) {
                mail($email, $subject, $message, $header . $email);
                //переадресация - сразу делаем get запрос с параметром set - мы на эту же страницу, и далее код не должен исполняться
                header('Location: contactForm.php?sent');
                exit();
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>

        <!--подключили бутстрап-->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="js/bootstrap.min.js">
        <!--подключаем онлайн-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <title>Send message</title>
    </head>
    <body>
    <?php include 'myheader.php' ?>
    <div class="container">
        <?php
        //проверяем  isset - был ли запрос get c параметром send
        if (isset($_GET['sent'])) :?>
            <div class="alert alert-success col-md-offset-3 col-md-6 col-xs-12">
                <strong>"Спасибо! Письмо отправлено"</strong>
            </div>
        <?php else:
            if (empty($errors) === false):
                foreach ($errors as $error):?>
                    <div class="alert alert-danger col-md-offset-3 col-md-6 col-xs-12">
                        <strong><?= "$error"; ?></strong>
                    </div>
                <?php endforeach;
            endif;
        endif;
        ?>
        <div class="row">
            <div class="col-md-offset-3 col-md-6 col-xs-12">
                <!--вместо value, чтобы оставались данные, если выдает какую-то ошибку-->
                <form class="form-horizontal form" role="form" action="contactForm.php" method="post" novalidate>
                    <!--Поле ввода Имя-->
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Имя: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"
                                   name="name" <?php if (isset($_POST['name'])) echo 'value="', $_POST['name'], '"'; ?>
                                   placeholder="Name">
                        </div>
                    </div>
                    <!--Поле ввода Email-->
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email: </label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control"
                                   name="email" <?php if (isset($_POST['email'])) echo 'value="', $_POST['email'], '"'; ?>
                                   placeholder="Email">
                        </div>
                    </div>
                    <!--Поле ввода Тема-->
                    <div class="form-group">
                        <label for="subject" class="col-sm-2 control-label">Тема: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"
                                   name="subject" <?php if (isset($_POST['subject'])) echo 'value="', $_POST['subject'], '"'; ?>
                                   id="subject" placeholder="Subject">
                        </div>
                    </div>
                    <!--Поле ввода Сообщение-->
                    <div class="form-group">
                        <label for="message" class="col-sm-2 control-label">Сообщение: </label>
                        <div class="col-sm-10">
                        <textarea name="message" class="form-control" id="message" cols="30" rows="5">
                            <?php if (isset($_POST['message'])) echo $_POST['message']; ?></textarea>
                        </div>
                    </div>
                    <!--Поле ввода Кнопка Отправить сообщение-->
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Отправить">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include 'myfooter.php' ?>
    </body>
    </html>
    <?php
} else {
    header('Location: login.php');
}
?>