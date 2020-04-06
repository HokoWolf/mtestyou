<?php

require('../../includes/insert_first_data.php');
unset($_SESSION['logged_user']);
header('Location: ../../index.php');
