<?php 
require(dirname(__FILE__).'/../../includes/insert_first_data.php');

$database = array(
  'users' => R::getAll( 'SELECT * FROM `users`' ),
  'topics' => R::getAll( 'SELECT * FROM `topics`' ),
  'tests' => R::getAll( 'SELECT * FROM `tests`' ),
);