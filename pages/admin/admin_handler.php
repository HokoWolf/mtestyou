<?php

require(dirname(__FILE__).'/../../php/admin/load_tables.php');

if($_POST['func'] == 'delete')
{
  R::exec('DELETE FROM '.$_POST['table'].' WHERE `id` = '.$_POST['id']);
}

else if($_POST['func'] == 'update')
{
  $table = $_POST['table'];
  $col = $_POST['col'];
  $value = $_POST['value'];
  $id = $_POST['id'];
  R::exec("UPDATE $table SET `$col` = \"$value\" WHERE id = $id");
}

else if($_POST['func'] == 'insert')
{
  $data = json_decode($_POST['data']);
  $new = R::dispense($_POST['table']);

  if($_POST['table'] == 'users')
  {
	  $new->login = $data->login;
	  $new->email = $data->email;
    $new->password = password_hash($data->password, PASSWORD_DEFAULT);
    $new->date = date('Y-m-d H:i:s');
    $new->type = $data->type;
    $new->firstname = $data->firstname;
    $new->lastname = $data->lastname;
    if($data->topics_id != '')
      $new->subject = R::load('topics', (int) $data->topics_id);
    R::store($new);
  }
  else if ($_POST['table'] == 'topics')
  {
    $new->name = $data->name;
    $new->topic_desc = $data->topic_desc;
    R::store($new);
  }
  else if ($_POST['table'] == 'tests')
  {
    $new->name = $data->name;
    $new->test_desc = $data->test_desc;
    $new->topics = R::load('topics', $data->topics_id);
    R::store($new);
  }
  else if ($_POST['table'] == 'questions')
  {
    if($data->tests_id == '')
      $data->tests_id = 1;
    $test = R::load('tests', $data->tests_id);
    $new->type = $data->type;
    $new->quest = $data->quest;
    $test->ownTestList[] = $new;
    R::store($test);
  }
}