<?php
session_start();
//блок логики

//обнулить счет
if(isset($_GET['reset'])&& $_GET['reset'] == 1){
  $_SESSION['player_win'] = 0;
  $_SESSION['ii_win'] = 0;
}
$start_hp = array('player_hp' => 3, 'ii_hp' => 3); //начальный запас HP
if(!isset($_SESSION["hp"])){
  $_SESSION["hp"] = $start_hp;
  if(!isset($_COOKIE['newround'])){
    //если нету куки отплавляем читать правила
    header('Location: /rulles.php');
  }
}
//ход компьютера
$strike = rand(1, 3);
//если в GET поступил ход игрока
if(isset($_GET['num'])){
  if($strike == $_GET['num']){
    $_SESSION["hp"]['player_hp'] -= 1;

  } else{
    $_SESSION["hp"]['ii_hp'] -= 1;

  }
} else{
  $push_button = "Жми кнопку";
}
//здоровье кончилось - конец игры
if ($_SESSION["hp"]['player_hp'] === 0) {
  unset($_SESSION["hp"]);
  header('Location: /index.php?win=0');
}
if ($_SESSION["hp"]['ii_hp'] === 0) {
  unset($_SESSION["hp"]);
  header('Location: /index.php?win=1');
}


?>
<!DOCTYPE html>

<html lang="ru">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/style.css">
  <title>Game1</title>
</head>
<body>
  <?php
  //  var_dump($curent_hp);
  ?>

  <h1>Игра Цифры 1</h1>
  <div class="container grid">
    <div class="player">
      <?php  echo $_SESSION["hp"]['player_hp']." из ".$start_hp['player_hp'] ?>
      <br><progress value="<? echo $_SESSION["hp"]['player_hp'] ?>" max="<? echo $start_hp['player_hp'] ?>">
        Здоровье
      </progress>
      <br><br>
      Нажато число:<br><p class="big_num"><?php echo $_GET[num] ?></p>
    </div>
    <div class="player">
      <?php  echo $_SESSION["hp"]['ii_hp']." из ".$start_hp['ii_hp'] ?>
      <br>
      <progress value="<? echo $_SESSION["hp"]['ii_hp'] ?>" max="<? echo $start_hp['ii_hp'] ?>">
        Здоровье
      </progress>
      <br><br>
      Ход ИИ:<br><p class="big_num"><?php
      if(isset($_GET['num'])){
        echo $strike;
      }
      ?>
    </p>
  </div>
  <div class="bottom">
    <div class="button_block">

      <?php
//если не нажата кнопка и не закончилось здоровье выводим надпись жми кнопку
      if(isset($push_button) && !isset($_GET['win'])){
        echo $push_button;
        unset ($push_button);
      }
  //если закончилось здоровье выводим победителя если нет - блок кнопок
      if(isset($_GET['win'])){
        if($_GET['win'] == 1){
          $winer = "Вы выиграли";
          $_SESSION['player_win'] += 1;
        }
        if($_GET['win'] == 0){
          $winer = "Компьютер победил";
          $_SESSION['ii_win'] += 1;
        }
        echo "<h1>$winer</h1>
        <br><a href='/index.php'><h2>Новая игра</h2></a>";
      } else{
//вывод блока кнопок
    echo '
      <br>
      <a href="index.php?num=1"><button type="button" name="button1">1</button></a>
      <a href="index.php?num=2"><button type="button" name="button2">2</button></a>
      <a href="index.php?num=3"><button type="button" name="button3">3</button></a>
    ';
    }
  ?>
    </div>
    <div class="score">
      Счёт
      <?php
      //если первая игра устанавливаем счёт 0:0
      if(!isset($_SESSION['player_win'])){
        $_SESSION['player_win'] = 0;
        $_SESSION['ii_win'] = 0;
      }
      //выводим счет игры
      echo $_SESSION['player_win'].":".$_SESSION['ii_win'];
      ?>
      <br>
      <a href="index.php?reset=1">Обнулить</a>
    </div>
  </div>
</div>




<?php
//для отладки
//var_dump($_SESSION);

?>

</body>
</html>
