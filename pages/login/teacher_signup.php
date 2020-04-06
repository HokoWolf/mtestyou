<?php
require(dirname(__FILE__).'/../../includes/insert_first_data.php');
require(dirname(__FILE__).'/../../php/login/teacher_signup_script.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>makeTestyou</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, inital-scale=1.0">

	<link rel="stylesheet" href="/media/css/login.css">
	<link rel="stylesheet" href="/media/css/login-bg3.css">
  <link rel="stylesheet" href="/media/css/reset.css">
  <link rel="stylesheet" href="/media/css/header.css">
</head>
<body>

  <?php require(dirname(__FILE__).'/../../includes/header.php'); ?>

  <div class="login" style="top: 12%;">

    <h1 class="logheader text-center">SignUP</h1>

    <form method="POST">

      <div class="form-group">
        <label for="login">Enter Login</label>
        <input type="text" class="form-control" name="login" placeholder="Введите login" value="<?php echo @$data['login']; ?>">
      </div>

      <div class="form-group">
        <label for="firstname">Last Name</label>
        <input type="text" class="form-control" name="firstname" placeholder="Введите фамилию" value="<?php echo @$data['firstname']; ?>">
      </div>

      <div class="form-group">
        <label for="lastname">First Name</label>
        <input type="text" class="form-control" name="lastname" placeholder="Введите имя" value="<?php echo @$data['lastname']; ?>">
      </div>

      <div class="form-group">
        <label for="email">Enter Email</label>
        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Введите email" value="<?php echo @$data['email']; ?>">
      </div>

      <div class="form-group">
        <label for="password">Enter password</label>
        <input type="password" class="form-control" name="password" placeholder="Введите пароль" value="<?php echo @$data['password']; ?>">
      </div>

      <div class="form-group">
        <label for="password2">Confirm password</label>
        <input type="password" class="form-control" name="password2" placeholder="Подтвердите пароль" value="<?php echo @$data['password2']; ?>">
      </div>

      <div class="form-group">
        <label for="subject">Subject</label>
        <select name="subject">
        <?php
          $subjects = R::getAll('SELECT `id`, `name` FROM topics');
          foreach ($subjects as $cat)
          {
            $cat_id = $cat['id'];
            $cat_name = $cat['name'];
            echo "<option value='$cat_id'>$cat_name</option>";
          }
        ?>
        </select>
      </div>

			<?php
        if (!empty($errors))
          echo '<div class="errors" style="font-weight: bold; color: red; font-size: 1.2em; text-shadow: 1px 1px black; text-align: center;">'.$errors[0].'</div>';
			?>

      <button type="submit" class="btn btn-dark btn-lg btn-block" name="do_signup">SignUP</button>

      <?php
        if (isset($_GET['go_test_id']))
          echo '<small>У Вас уже есть аккаунт? Войдите в профиль <a class="dosignup" href="login.php?go_test_id='.$_GET['go_test_id'].'">здесь</a></small>';
        else
          echo '<small>У Вас уже есть аккаунт? Войдите в профиль <a class="dosignup" href="login.php">здесь</a></small>';
      ?>

      <input type="hidden" name="go_test_id" value="<?php echo $_GET['go_test_id']; ?>">

    </form> <!--end of form-->

  </div>

</body>
</html>
