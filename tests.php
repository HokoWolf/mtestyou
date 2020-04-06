<?php require 'includes/insert_first_data.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>makeTestyou</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" type="text/css" href="media/css/reset.css">
  <link rel="stylesheet" type="text/css" href="media/css/header.css">
  <link rel="stylesheet" href="media/css/tests.css">
  <link rel="stylesheet" href="media/css/bootstrap-grid.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/media/fontawesome/css/all.min.css"></link>
</head>
<body>
  <?php require 'includes/header.php'; ?>

  <div class="wrapper">

    <h1 class="page_title">Виберіть тест</h1>

    <div class="categories">
      <nav class="nav_cat">
        <ul class="cat_menu">
          <?php
            $per_page = 3;
            $page = 1;
            if(isset($_GET['page'])){
              $page = $_GET['page'];
            }
            if($_GET['cat_id'] == 0){
              $total_tests_count = R::count('tests');
            }
            else{
              $total_tests_count = R::count('tests', 'topics_id = ?', [$_GET['cat_id']]);
            }
            $categories = R::getAll('SELECT * FROM `topics`');
            $total_pages = ceil($total_tests_count / $per_page);
            if($page <= 1 || $page > $total_pages){
              $page = 1;
            }
            $offset = $per_page * ($page - 1);
            if($_GET['cat_id'] == 0){
              ?>
              <li class="cat"><a class="btn active" href="tests.php?cat_id=0">Всі тести</a></li>
              <?php
              $tests = R::getAll("SELECT * FROM `tests` ORDER BY `id` DESC LIMIT $offset, $per_page");
            }
            else {
              ?>
              <li class="cat"><a class="btn" href="tests.php?cat_id=0">Всі тести</a></li>
              <?php
              $cat_id = $_GET['cat_id'];
              $tests = R::getAll("SELECT * FROM `tests` WHERE `topics_id` = $cat_id ORDER BY `id` DESC LIMIT $offset, $per_page");
            }
            foreach ($categories as $cat) {
              if($_GET['cat_id'] == $cat['id']){
                ?>
                <li class="cat"><a class="btn active" href="tests.php?cat_id=<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></a></li>
                <?php
              }
              else {
                ?>
                <li class="cat"><a class="btn" href="tests.php?cat_id=<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></a></li>
                <?php
              }
            }
          ?>
        </ul> <!--end of cat_menu-->
      </nav> <!--end of nav_cat-->
    </div> <!--end of categories div-->

    <div class="tests">
      <div class="row">
        <?php
          foreach ($tests as $test) {
            ?>
            <div class="col-xl-4 col-md-6">

              <article class="test">

                <div class="test_image"><h2><?php echo $test['name']; ?></h2></div>

                <div class="test_info">
                  <p><?php echo mb_strimwidth($test['test_desc'], 0, 100).' ...'; ?></p>
                  <div class="go_to_test">
                    <a href="pages/test/show_test.php?id=<?php echo $test['id']; ?>">Test you</a>
                  </div>
                </div>

              </article>

            </div>
            <?php
          }
        ?>
      </div> <!--row`s end-->
    </div> <!--end of tests div-->

    <div class="paginator">
      <?php
        if ($page > 1) {
          ?>
          <a href="tests.php?page=<?php echo ($page - 1); ?>&cat_id=<?php echo $_GET['cat_id']; ?>" class="pag_page"><i class="fas fa-arrow-left"></i></a>
          <?php
        }

        for ($i = 1; $i <= $total_pages; $i++) {

          if ($total_pages > 1) {

            if ($page == 1 && $i == 1) {
              ?>
              <a style="margin-left: 70px;" href="tests.php?page=<?php echo $i; ?>&cat_id=<?php echo $_GET['cat_id']; ?>" class="pag_page active"><?php echo $i; ?></a>
              <?php
            }
            else {

              if($page == $i){
                ?>
                <a href="tests.php?page=<?php echo $i; ?>&cat_id=<?php echo $_GET['cat_id']; ?>" class="pag_page active"><?php echo $i; ?></a>
                <?php
              }
              else {
                ?>
                <a href="tests.php?page=<?php echo $i; ?>&cat_id=<?php echo $_GET['cat_id']; ?>" class="pag_page"><?php echo $i; ?></a>
                <?php
              }

            }

          }

        }

        if ($page < $total_pages) {
          ?>
          <a href="tests.php?page=<?php echo ($page + 1); ?>&cat_id=<?php echo $_GET['cat_id']; ?>" class="pag_page"><i class="fas fa-arrow-right"></i></a>
          <?php
        }
      ?>
    </div> <!--end of paginator-->

  </div> <!--end of wrapper-->

</body>
</html>
