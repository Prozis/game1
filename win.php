<?php
unset($_COOKIE['hp']); //Удаляем куку
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
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
