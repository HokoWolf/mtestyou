<?php require('php/login/login_script.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>makeTestyou</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, inital-scale=1.0">

  <link rel="stylesheet" type="text/css" href="media/css/reset.css">
  <link rel="stylesheet" type="text/css" href="media/css/header.css">
  <link rel="stylesheet" type="text/css" href="media/css/login.css">
  <link rel="stylesheet" type="text/css" href="media/css/login-bg1.css">
</head>
<body>

  <?php require('includes/header.php'); ?>

  <div class="login" style="top: 20%;">

    <h1 class="logheader">LogIN</h1>

    <form method="POST">
    
      <div>
        <label style="font-size: 1.8em;">Login</label>
        <input type="text" name="login" placeholder="Введите login" value="<?php echo @$data['login']; ?>">
      </div>
      
      <div>
        <label style="font-size: 1.7em;">Password</label>
        <input type="password" name="password" placeholder="Введите пароль">
      </div>

			<?php
        if (!empty($errors))
          echo '<div class="errors" style="font-weight: bold; color: red; font-size: 1.2em; text-shadow: 1px 1px black; text-align: center;">'.$errors[0].'</div>';
			?>

      <button type="submit" name="do_login">LogIN</button>

      <?php
        if (isset($_GET['go_test_id']))
          echo '<small>У Вас нет аккаунта? Создайте свой аккаунт <a class="dosignup" href="pages/login/choose.php?go_test_id='.$_GET['go_test_id'].'">здесь</a></small>';
        else
          echo '<small>У Вас нет аккаунта? Создайте свой аккаунт <a class="dosignup" href="pages/login/choose.php">здесь</a></small>';
      ?>
    </form>
  </div>
</body>
</html>
