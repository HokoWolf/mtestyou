<?php include(dirname(__FILE__).'/../../includes/insert_first_data.php'); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>makeTestyou</title>

  <link rel="stylesheet" href="/media/css/reset.css">
  <link rel="stylesheet" href="/media/css/header.css">
  <link rel="stylesheet" href="/media/css/choose.css">

<body>
  <?php include(dirname(__FILE__).'/../../includes/header.php');?>

  <div class="wrapper">
    <h2>Выберите, как вы хотите зарегестрироваться</h2>
    <a id="student" href="student_signup.php">Ученик</a>
    <a id="teacher" href="teacher_signup.php">Учитель</a>
    <?php
        if (isset($_GET['go_test_id']))
          echo '<small>У Вас уже есть аккаунт? Войдите в профиль <a class="dosignup" href="/login.php?go_test_id='.$_GET['go_test_id'].'">здесь</a></small>';
        else
          echo '<small>У Вас уже есть аккаунт? Войдите в профиль <a class="dosignup" href="/login.php">здесь</a></small>';
      ?>
  </div>
</body>
</html>
