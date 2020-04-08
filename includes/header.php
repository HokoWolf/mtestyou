<header>
  <a title="На главную страницу" href="/"><div class="header__logo"><img src="/media/images/logohead.png" alt="logo"></div></a>
  <nav>
    <div class="topnav" id="myTopnav">
      <a href="#" id="menu" class="icon">&#9776;</a>
      <a href="/">HOME</a>
      <a href="/tests.php?cat_id=0">TESTS</a> <!--/tests.php?cat_id=0-->
      <?php
        if($_SESSION['logged_user']['type'] == 'teacher'){
          ?><a href="/testmaker.php">CONSTRUCTOR</a> <!--/testmaker.php--><?php
        }
      ?>
      <?php
        if (isset($_SESSION['logged_user']))
          echo '<a href="/php/login/logout.php" class="log_bt">LOG OUT</a>';
        else
          echo '<a href="/login.php" class="log_bt">LOG IN</a>';
      ?>
    </div>
  </nav>
</header>

<script type="text/javascript" src="/media/js/header.js"></script>
