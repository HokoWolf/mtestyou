<?php
  require 'includes/insert_first_data.php';
  $data = $_POST;
  if (isset($data['do_signup'])) {

    $errors = array();
    if (trim($data['login']) == '') {
      $errors[] = 'Enter yours login!';
    }

    if (trim($data['email']) == '') {
      $errors[] = 'Enter your Email!';
    }

    if ($data['password'] == '') {
      $errors[] = 'Enter your password!';
    }

    if ($data['password2'] != $data['password']) {
      $errors[] = 'Password confirming is not succesful!';
    }

    if (R::count( 'users', 'login = ?', array( $data['login'] ) ) > 0) {
      $errors[] = 'This login already exists!';
    }

    if (R::count( 'users', 'login = ?', array( $data[ 'email' ] ) ) > 0) {
      $errors[] = 'This Email already exists!';
    }

    if (empty($errors)) {
      $user = R::dispense('users');
      $user->login = $data['login'];
      $user->email = $data['email'];
      $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
      $user->date = date('Y-m-d H:i:s');
      R::store($user);
      $_SESSION['logged_user'] = $user;
      if (isset($_SESSION['back_page'])) {
        $back_page = $_SESSION['back_page'];
        unset($_SESSION['back_page']);
        header('Location: ' . $back_page);
      }
      else {
        header('Location: /');
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>makeTestyou</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, inital-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" type="text/css" href="media/css/login.css">
  <link rel="stylesheet" type="text/css" href="media/css/reset.css">
  <link rel="stylesheet" type="text/css" href="media/css/header.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>

  <?php require 'includes/header.php'; ?>

  <div class="login">

    <h1 class="logheader text-center">SignUP</h1>

    <form method="POST" action="/signup.php">

      <div class="form-group">
        <label for="login">Enter Login</label>
        <input type="text" class="form-control" name="login" placeholder="Enter login" value="<?php echo @$data['login']; ?>">
      </div>

      <div class="form-group">
        <label for="email">Enter Email</label>
        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter your Email" value="<?php echo @$data['email']; ?>">
      </div>

      <div class="form-group">
        <label for="password">Enter password</label>
        <input type="password" class="form-control" name="password" placeholder="Enter your password" value="<?php echo @$data['password']; ?>">
      </div>

      <div class="form-group">
        <label for="password2">Confirm password</label>
        <input type="password" class="form-control" name="password2" placeholder="Confirm your password" value="<?php echo @$data['password2']; ?>">
      </div>

			<?php
			   if (!empty($errors)) {
           echo '<div class="errors" style="font-weight: bold; color: red; font-size: 1.2em; text-shadow: 1px 1px black; text-align: center;">'.$errors[0].'</div>';
			   }
			?>

      <button type="submit" class="btn btn-dark btn-lg btn-block" name="do_signup">SignUP</button>

      <?php
        if (isset($_GET['go_test_id'])) {
          ?>
          <small>You have no account? Create new account <a href="login.php?go_test_id=<?php echo $_GET['go_test_id']; ?>">here</a></small>
          <?php
        }
        else {
          ?>
          <small>You have no account? Create new account <a href="login.php">here</a></small>
          <?php
        }
      ?>

      <input type="hidden" name="go_test_id" value="<?php echo $_GET['go_test_id']; ?>">

    </form>

  </div>

</body>
</html>
