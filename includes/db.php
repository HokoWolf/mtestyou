<?php
require_once("config.php");
require_once(dirname(__FILE__)."/../libs/rb.php");

// if database not exists
$link = mysqli_connect($config['db']['server'], $config['db']['username'], $config['db']['password']);
$q = "CREATE DATABASE IF NOT EXISTS ".$config['db']['name'];
mysqli_query($link, $q);
mysqli_close($link);
unset($q);
unset($link);

R::setup('mysql:host='.$config['db']['server'].';dbname='.$config['db']['name'], $config['db']['username'], $config['db']['password']);
session_start();

if(!R::testConnection()) die('No DB connection');
