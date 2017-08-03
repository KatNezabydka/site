<?php
session_start();
$file = 'registered.txt';
$number = 0;

//нашли нашу строку, сохранили ее номер, и сделали нужную для перезаписи строку $item
if ($handle = @fopen($file, "r")) {
    while (($buffer = fgets($handle)) !== false) {
        $number++;
        $item = unserialize($buffer);
        if (($item['email'] === $_SESSION['email']) and ($item['password'] === $_SESSION['password'])) {
            // нашли запись необходимо перезаписать в него фон и закрыть сессию
            $item['bgcolor'] = $_SESSION['bgcolor'];
            $item = serialize($item) . PHP_EOL;
            //fwrite($handle, serialize($item) . PHP_EOL);
            break;
        }
    }
    fclose($handle);
}

//А теперь мы меня эту строку в файле на нашу с новым фоном
$file1=file($file);
$open=@fopen($file,"w");
for($i=0;$i<count($file1);$i++)
{
    if(($i+1)!=$number){fwrite($open,$file1[$i]);}
    else{fwrite($open,$item);}
}
fclose($open);

session_destroy();
header('Location: login.php');

/*--------------------------------------Код дописывает строчку в конец файла-------------------------------------------------------------*/

//if ($handle = @fopen($file, "a+")) {
//    flock($handle, LOCK_EX);//Блокировка файла,на запись другими процессами
//    while (($buffer = fgets($handle)) !== false) {
//        $item = unserialize($buffer);
//        if (($item['email'] === $_SESSION['email']) and ($item['password'] === $_SESSION['password'])) {
//            // нашли запись необходимо перезаписать в него фон и закрыть сессию
//            $item['bgcolor'] = $_SESSION['bgcolor'];
//            echo "<p>наш фон сейчас =  </p>" . $item['bgcolor'];
//            fwrite($handle, serialize($item) . PHP_EOL);
//            break;
//        }
//    }
//    echo "<p> Попали в конец??? </p>";
//
//    flock($handle, LOCK_UN);//СНЯТИЕ БЛОКИРОВКИ
//    fclose($handle);
//}
//
//session_destroy();
//echo "<p> Сессия закрылась </p>";

/*--------------------------------------============--------------------------------------------------------------------------------*/



