<?php


session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {


    $message = [];
    $comments = [];
    $file = "comment.txt";

    if (!empty($_POST) === true) {

        $name = strip_tags($_POST['name']);
        $comment = mb_convert_encoding(strip_tags($_POST['comment']), 'UTF-8');
        $text = $name . "---" . $comment;

        if (empty($name) === true || empty($comment) === true) {
            $message[] = "Каждое поле должно быть заполненно";
        } else {
            if (preg_match('/[^(\w) | (\x7F-\xFF) | (\s)]/', $name)) {
                $message[] = "Имя может содержать только буквенные символы, знаки подчеркивания и пробелы.";
            }

            if (empty($message) === true) {
                // записываем коммент
                $handle = @fopen($file, 'a');
                fwrite($handle, $text . PHP_EOL);
                fclose($handle);
                header('Location: comment.php?sent');
                exit();
            } else {
                $message[] = "Ошибка записи";
            }
        }


    }
    if (isset($_GET['sent']) === true){
        $handle = @fopen($file, "r");
        while (($buffer = fgets($handle)) !== false) {
            $comments[] = $buffer;
        }
        fclose($handle);
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
        <title>Comments</title>
        <style>
            .fon {
                background-color: Window;
            }
        </style>
    </head>
    <body>
    <?php include 'myheader.php' ?>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-6 col-xs-12 fon">
<!--                вывод ошибок-->
                <?php if (empty($message) === false): ?>
                    <div class="alert alert-info" role="alert">
                        <?php foreach ($message as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div><br>
                <?php endif; ?>
<!-- вывод комментариев-->
                <h2><strong>Комментарии:</strong></h2>
                <?php if (isset($_GET['sent']) === true): ?>
                    <?php foreach ($comments as $item):
                        $item = explode("---", $item) ?>
                        <p><?php echo "<strong>" . $item[0] . "</strong>" . ": " . $item[1]; ?></p>
                    <?php endforeach; ?>
                    <?php endif;?>
                <hr>
                <form class="form-signin" role="form" action="comment.php" method="post">
                    <label for="name">Имя: </label><input type="text" class="form-control" name="name" id="name"><br>
                    <label for="comment">Ваш комментарий: </label><textarea name="comment" class="form-control"
                                                                            id="comment" cols="30"
                                                                            rows="5"></textarea><br>
                    <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="Отправить"
                           id="submit">
                </form>
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
