<?php
$start_hp = array('player_hp' => 3, 'ii_hp' => 3); //начальный запас HP
if(!isset($_COOKIE["hp"])){
  setcookie("hp", json_encode($start_hp), time() + 360); //Создаем куку если её нет
  header('Location: /');
}
$curent_hp = json_decode($_COOKIE["hp"], true); //получаем значения HP из куки
//var_dump($curent_hp);
if ($curent_hp['player_hp'] === 0) {
  setcookie("hp", null, -1);
//  unset($_COOKIE['hp']); //Удаляем куку
  header('Location: /win.php?win=0');
}
if ($curent_hp['ii_hp'] === 0) {
setcookie("hp", null, -1);
  //unset($_COOKIE['hp']); //Удаляем куку
  header('Location: /win.php?win=1');
}
$strike = rand(1, 3);

if(isset($_GET['num'])){
  if($strike == $_GET['num']){
    $curent_hp["player_hp"] -= 1;
  setcookie("hp", json_encode($curent_hp), time() + 360);
  //  header('Location: /');
  } else{
    $curent_hp["ii_hp"] -= 1;
  setcookie("hp", json_encode($curent_hp), time() + 360);
  //  header('Location: /');
  }
} else{
  echo "Жми кнопку";
}

echo "<br>";

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
  var_dump($curent_hp);
   ?>
  <a href="index.php"><h2>На главную</h2></a>
  <h1>Игра1</h1>
  <div class="container">
    <div class="player">
      <progress value="<? echo $curent_hp['player_hp'] ?>" max="<? echo $start_hp['player_hp'] ?>">
        Здоровье
      </progress>
      <br>
      <a href="index.php?num=1"><button type="button" name="button1">1</button></a>
      <a href="index.php?num=2"><button type="button" name="button2">2</button></a>
      <a href="index.php?num=3"><button type="button" name="button3">3</button></a>
      <br>
      Нажато число: <?php echo $_GET[num] ?>

    </div>

    <div class="player">

      <progress value="<? echo $curent_hp['ii_hp'] ?>" max="<? echo $start_hp['ii_hp'] ?>">
        Текст
      </progress>
      <br>
      Ход ИИ: <?php echo $strike ?>

    </div>
  </div>
</body>
</html>
