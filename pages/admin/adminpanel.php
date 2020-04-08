<?php require(dirname(__FILE__).'/../../php/admin/load_tables.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin Panel</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="/media/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="/media/css/adminpanel.css" />
    <link rel="stylesheet" href="/media/fontawesome/css/all.min.css" />
  </head>
  <body>
    <header>
      <a title="Menu" href="#" id="sidebar-btn">
        <div class="header__logo">
          <img src="/media/images/logohead.png" alt="logo" />
        </div>
      </a>
    </header>

    <div id="sidebarMenu">
      <ul>
        <?php require(dirname(__FILE__).'/../../php/admin/echo_tables_bt.php'); ?>
        <li><a id="logout" href="/php/login/logout.php">Log Out <i class="fas fa-sign-out-alt"></i></a></li>
      </ul>
    </div>

    <div id="container">
      <?php require(dirname(__FILE__).'/../../php/admin/echo_tables.php'); ?>
      <a id="insert" href="#" type="button">Insert <i class="fas fa-plus-square"></i></a>
    </div>

    <script type="text/javascript" src="/media/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="/media/js/adminpanel.js"></script>
    
  </body>
</html>
