<?php
session_start();
//создаем куку что-бы заново не читать правила игры
setcookie('newround', 1, time() + 600);
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Game end</title>
  </head>
  <body>
    <?php
    //удаляем переменную со здоровьем
unset($_SESSION["hp"]);
if($_GET['win'] == 1){
  $winer = "Player";
}
if($_GET['win'] == 0){
  $winer = "II";
}
     ?>
    <h1><? echo $winer?> Win</h1>

    <a href="/index.php"><h2>Новая игра</h2></a>
  </body>
</html>
