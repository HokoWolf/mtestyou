<?php

require(dirname(__FILE__).'/../../includes/insert_first_data.php');

$data = $_POST;
if (isset($data['do_login'])) {
  $errors = array();
  $user = R::findOne('users', 'login = ?', array($data['login']));
  if ($user) {
    if (password_verify($data['password'], $user->password)) {
      $_SESSION['logged_user'] = $user;
      if($user->type == 'admin')
        header('Location: pages/admin/adminpanel.php');
      else if (isset($_SESSION['back_page']))
      {
        $back_page = $_SESSION['back_page'];
        unset($_SESSION['back_page']);
        header("Location: $back_page");
      }
      else
        header('Location: index.php');
    }
    else
      $errors[] = 'This Password is not right!';
  }
  else
    $errors[] = 'User with such login is not found!';
}