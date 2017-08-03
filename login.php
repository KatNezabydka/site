<?php
$file = 'registered.txt';
$errors=[];
if (!empty($_POST)) {

    $email = isset($_POST['email']) ? mb_strtolower($_POST['email']) : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if ($handle = @fopen($file, "r")) {
        while (($buffer = fgets($handle)) !== false) {
            $item = unserialize($buffer);
            if (($item['email'] === $email) and ($item['password'] === $password)) {
                // нашли запись необходимо активировать сессию для него
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['name'] = $item['name'];
                $_SESSION['bgcolor'] = $item['bgcolor'];
                header('Location: home_page.php');
                exit;
                break;
            }
        }
        $errors[] = "Неверный email/пароль";
        header('Location: ', $_SERVER['PHP_SELF']);
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
    <title>Authorization</title>

</head>
<body>
<?php include 'myheader.php' ?>
<div class="container">

    <?php foreach ($errors as $error) echo "<div class='alert alert-danger col-md-offset-3 col-md-6 col-xs-12'><strong>" . $error . "; </strong></div>";
          header('Location: ', $_SERVER['PHP_SELF']);
          ?>

<!--    <div class='alert alert-danger col-md-offset-3 col-md-6 col-xs-12'><strong>--><?php //if (!empty($errors)) foreach ($errors as $error) echo $error?><!--</strong></div>-->
    <div class="col-md-offset-4 col-md-4 col-xs-12">
        <form class="form-signin" role="form" action="login.php" method="post">
            <h2 class="form-signin-heading">Вход: </h2>
            <input type="email" class="form-control" name="email" placeholder="Email" required="" autofocus=""><br>
            <input type="password" class="form-control" name="password" placeholder="Password" required=""><br>
            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Войти">
        </form>
    </div>
</div>
<?php include 'myfooter.php' ?>
</body>
</html>