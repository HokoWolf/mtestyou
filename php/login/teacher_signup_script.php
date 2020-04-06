<?php

$data = $_POST;

if (isset($data['do_signup']))
{
  $errors = array();

  if (trim($data['login']) == '')
    $errors[] = 'Enter yours login!';

  if (trim($data['email']) == '')
    $errors[] = 'Enter your Email!';

  if ($data['password'] == '')
    $errors[] = 'Enter your password!';

  if ($data['password2'] != $data['password'])
    $errors[] = 'Password confirming is not succesful!';

  if (R::count( 'users', 'login = ?', array( $data['login'] ) ) > 0)
    $errors[] = 'This login already exists!';

  if (R::count( 'users', 'email = ?', array( $data[ 'email' ] ) ) > 0)
    $errors[] = 'This Email already exists!';

  if (empty($errors))
  {
    $user = R::dispense('users');
    $user->login = $data['login'];
    $user->email = $data['email'];
    $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
    $user->date = date('Y-m-d H:i:s');
    $user->type = 'teacher';
    $user->firstname = $data['firstname'];
	  $user->lastname = $data['lastname'];
	  $user->subject = R::load('topics', $data['subject']);
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
