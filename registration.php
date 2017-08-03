<?php
$header = "Content-Type: text/plain; charset=utf-8\r\n";
$file = 'registered.txt';
$errors = [];

if (!empty($_POST)) {

    $name = strip_tags($_POST['name']);
    $email = strip_tags(mb_strtolower($_POST['email']));
    $password = strip_tags($_POST['password']);

    if (empty($name) === true || empty($email) === true || empty($password) === true) {
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
            //Проверяем есть ли такой пользователь уже? если да, просим ввести другой email
            if ($handle = @fopen($file, "r")) {
                while (($buffer = fgets($handle)) !== false) {
                    $item = unserialize($buffer);
                    if (($item['email'] === $email)) {
                        $errors[] = "Пользователь с таким email уже существует";
                        header('Location: ', $_SERVER['PHP_SELF']);
                        break;
                    }
                }
                fclose($handle);
            }
        }
        //Если такой имэйл не найден, регистрируем нового пользователя
        if (empty($errors) === true) {
            if ($handle = @fopen($file, 'a')) {
                $text['name'] = $name;
                $text['password'] = $password;
                $text['email'] = $email;
                $text['bgcolor'] = 'silver';
                flock($handle, LOCK_EX);//Блокировка файла,на запись другими процессами
                $flagRegistration = fwrite($handle, serialize($text) . PHP_EOL);
                flock($handle, LOCK_UN);//СНЯТИЕ БЛОКИРОВКИ
                fclose($handle);
            }
        }
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
    <title>Authorization</title>

</head>
<body>
<?php include 'myheader.php' ?>
<div class="container">
    <?php
    if (!isset($flagRegistration) === false) {
        echo " <div class='alert alert-success col-md-offset-3 col-md-6 col-xs-12'><strong>Регистрация успешно завершенна</strong></div>";
        header('Location: ', $_SERVER['PHP_SELF']);
    } else {
        foreach ($errors as $error) echo "<div class='alert alert-danger col-md-offset-3 col-md-6 col-xs-12'><strong>" . $error . "; </strong></div>";
        header('Location: ', $_SERVER['PHP_SELF']);
    }
    ?>

    <div class="col-md-offset-4 col-md-4 col-xs-12">
        <form class="form-signin" role="form" action="registration.php" method="post">
            <h2 class="form-signin-heading">Регистрация: </h2>
            <input type="text" class="form-control" name="name"
                   placeholder="Name" <?php if (isset($_POST['name'])) echo 'value="', $_POST['name'], '"'; ?>
                   required="" autofocus=""><br>
            <input type="email" class="form-control" name="email"
                   placeholder="Email" <?php if (isset($_POST['email'])) echo 'value="', $_POST['email'], '"'; ?>
                   required="" autofocus=""><br>
            <input type="password" class="form-control" name="password" placeholder="Password" required=""><br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
        </form>
    </div>
</div>
<?php include 'myfooter.php' ?>
</body>
</html>