<?php

  require 'config.php';
  include 'C:/Program Files/OSPanel/domains/maketestyou.loc/libs/rb.php';

  $link = mysqli_connect($config['db']['server'], $config['db']['username'], $config['db']['password']);

  if(!$link) die('No DB connection');

  $q = "CREATE DATABASE IF NOT EXISTS ".$config['db']['name'];
  mysqli_query($link, $q);

  mysqli_close($link);

  R::setup('mysql:host='.$config['db']['server'].';dbname='.$config['db']['name'], $config['db']['username'], $config['db']['password']);
  session_start();

  if(!R::testConnection()) die('No DB connection');

?>
