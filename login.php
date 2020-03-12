<?php
  require('includes/insert_first_data.php');
  $data = $_POST;
  if (isset($data['do_login'])) {
    $errors = array();
    $user = R::findOne('users', 'login = ?', array($data['login']));
    if ($user) {
      if (password_verify($data['password'], $user->password)) {
        $_SESSION['logged_user'] = $user;
        if (isset($_SESSION['back_page'])) {
          $back_page = $_SESSION['back_page'];
          unset($_SESSION['back_page']);
          header('Location: ' . $back_page);
        }
        else{
          header('Location: index.php');
        }
      }
      else {
        $errors[] = 'This Password is not right!';
      }
    }
    else {
      $errors[] = 'User with such login is not found!';
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

  <?php require('includes/header.php'); ?>

  <div class="login" style="top: 20%;">

    <h1 class="logheader">LogIN</h1>

    <form method="POST">
    
      <div>
        <label style="font-size: 1.8em;">Login</label>
        <input type="text" name="login" placeholder="Enter login" value="<?php echo @$data['login']; ?>">
      </div>
      
      <div>
        <label style="font-size: 1.7em;">Password</label>
        <input type="password" name="password" placeholder="Enter your password">
      </div>

				<?php
          if (!empty($errors))
            echo '<div class="errors" style="font-weight: bold; color: red; font-size: 1.2em; text-shadow: 1px 1px black; text-align: center;">'.$errors[0].'</div>';
				?>

        <button type="submit" name="do_login">LogIN</button>

        <?php
          if (isset($_GET['go_test_id'])) {
            ?><small>You have no account? Create new account <a href="signup.php?go_test_id=<?php echo $_GET['go_test_id']; ?>">here</a></small><?php
          } else {
            ?><small>You have no account? Create new account <a href="signup.php">here</a></small><?php
          }
        ?>
      </form>
    </div>

</body>
</html>
