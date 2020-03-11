<header>
  <a title="На главную страницу" href="/"><div class="header__logo"><img src="../media/images/logohead.png" alt="logo"></div></a>
  <nav>
    <div class="topnav" id="myTopnav">
      <a href="/">HOME</a>
      <a href="/tests.php?cat_id=0">TESTS</a>
      <a href="/testmaker.php">CONSTRUCTOR</a>
      <!--<a href="#">ABOUT US</a>
      <a href="#">CONTACTS</a>-->
      <?php
        if (isset($_SESSION['logged_user'])) {
          ?>
          <a href="/logout.php" class="log_bt">LOG OUT</a>
          <?php
        }
        else {
          ?>
          <a href="/login.php" class="log_bt">LOG IN</a>
          <?php
        }
      ?>
      <a href="#" id="menu" class="icon">&#9776;</a>
    </div>
  </nav>
</header>

<script type="text/javascript" src="../media/scripts/header.js"></script>
<script src="../media/scripts/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
