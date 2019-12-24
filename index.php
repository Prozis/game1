<?php
session_start();
//блок логики
//вывод победителя на этой же странице при помощи переменной $_GET['win'] с сохранением последнего хода

//обнулить счет
if(isset($_GET['reset'])&& $_GET['reset'] == 1){
  $_SESSION['player_win'] = 0;
  $_SESSION['ii_win'] = 0;
}
//если нету куки отплавляем читать правила
if(!isset($_COOKIE['newround'])){
  header('Location: /rulles.php');
}
$start_hp = array('player_hp' => 3, 'ii_hp' => 3); //начальный запас HP
//если нету переменной здоровья и не выигрышная страница устанавливаем начадьные HP
if(!isset($_SESSION["hp"]) && !isset($_GET['win'])){
  $_SESSION["hp"] = $start_hp;
}
//ход компьютера
$strike = rand(1, 3);
//если в GET поступил ход игрока и не выигрышная страница проверяем кто выиграл раунд и отнимаем 1 HP
if(isset($_GET['num']) && !isset($_GET['win'])){
  if($strike == $_GET['num']){
    $_SESSION["hp"]['player_hp'] -= 1;
  } else {
    $_SESSION["hp"]['ii_hp'] -= 1;
  }
} else {
  //если ход не поступил позже над кнопками выведем надпись
  $push_button = "Жми кнопку";
}
// если не выигрышная страница проверяем здоровье (на всякий случай без приведения типов данных),
// если кончилось - конец игры и отправляем на выигрышную страницу с сохранием победителя и последних ходов в GET
if(!isset($_GET['win'])){
  if ($_SESSION["hp"]['player_hp'] === 0) {
    header("Location: /index.php?win=0&num={$_GET['num']}&strike={$strike}");
  }
  if ($_SESSION["hp"]['ii_hp'] === 0) {
    header("Location: /index.php?win=1&num={$_GET['num']}&strike={$strike}");
  }
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
  <h1>Игра Цифры 1</h1>
  <div class="container grid">
    <div class="player">
      <?php  echo $_SESSION['hp']['player_hp']." из ".$start_hp['player_hp'] ?>
      <br><progress value="<? echo $_SESSION['hp']['player_hp'] ?>" max="<? echo $start_hp['player_hp'] ?>">
        Здоровье
      </progress>
      <br><br>
      Нажато число:<br><p class="big_num"><?php echo $_GET[num] ?></p>
    </div>
    <div class="player">
      <?php  echo $_SESSION['hp']['ii_hp']." из ".$start_hp['ii_hp'] ?>
      <br>
      <progress value="<? echo $_SESSION['hp']['ii_hp'] ?>" max="<? echo $start_hp['ii_hp'] ?>">
        Здоровье
      </progress>
      <br><br>
      Ход ИИ:<br><p class="big_num"><?php
      //выводим если есть ход игрока или выигрышный раунд
      if(isset($_GET['num']) || isset($_GET['win'])){
        if(isset($_GET['strike'])){
          echo $_GET['strike'];
        } else {
          echo $strike;
        }
      }
      ?>
    </p>
  </div>
  <div class="bottom">
    <div class="button_block">
      <?php
      //если не нажата кнопка и не закончилось здоровье выводим надпись жми кнопку (переменная создана в начале)
      if(isset($push_button) && !isset($_GET['win'])){
        echo $push_button;
        unset ($push_button);
      }
      //если закончилось здоровье выводим победителя если нет - блок кнопок
      if(isset($_GET['win'])){
        if($_GET['win'] == 1){
          $winer = "Вы выиграли";
          $_SESSION['player_win'] += 1;
          //обнуляем HP
          unset($_SESSION["hp"]);
        }
        if($_GET['win'] == 0){
          $winer = "Компьютер победил";
          $_SESSION['ii_win'] += 1;
          unset($_SESSION["hp"]);
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
      if(!isset($_SESSION['player_win']) || !isset($_SESSION['ii_win'])){
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
