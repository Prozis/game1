<?php
//создаем куку что-бы заново не читать правила игры
setcookie('newround', 1, time() + 6000);
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Привила</title>
  </head>
  <body>
    <div class="container">


    <div class="rulles">
      <h2>Добро пожаловать в игру</h2>
      <p>Привила просты: жмеш кнопку с цифрой от 1 до 3, компьютер тоже ходит,
      если ваши цифры одинаковы, снимается еденица здоровья игрока, если цифры разные -
    снимется еденица здоровья компьютера. У кого первого здоровье закончится, тот и
  проиграл</p>
  <a href="index.php">Понял, начинаем</a>
    </div>
      </div>
  </body>
</html>
