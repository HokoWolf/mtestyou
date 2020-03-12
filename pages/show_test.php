<?php
  require '../includes/insert_first_data.php';
  $test_id = $_GET['id'];
  $test = R::load('tests', $test_id);

  if(!key_exists('logged_user', $_SESSION)){
    $_SESSION['back_page'] = $_SERVER['REQUEST_URI'];
    header('Location: /login.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>makeTestyou</title>

  <link rel="stylesheet" href="../media/css/test.css">
  <link rel="stylesheet" href="../media/css/reset.css">
  <link rel="stylesheet" href="../media/css/header.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

  <script src="https://kit.fontawesome.com/545ee76f32.js" crossorigin="anonymous"></script>
</head>
<body>

  <?php require '../includes/header.php'; ?>

  <div class="wrapper">
  <div class="test-header">
    <h1 class="test-title"><?php echo $test['name']; ?></h1>
    <p class="test-desc"><?php echo $test['test_desc']; ?></p>
  </div>
  <div class="test">
    <span>Результати пройденого Вами тесту будуть впливати на Вашу статистику. Так що докладіть максимум зусиль :)</span>

    <form action="show_test_result.php" method="POST">
      <input type="hidden" name="checked_test_id" value="<?php echo $test_id; ?>">
      <?php

        $counter = 1;
        $quests = R::getall('SELECT * FROM `questions` WHERE `tests_id` = ?', [ $test_id ]);
        foreach ($quests as $quest) {
          $q = json_decode($quest['quest'], true);
          ?>

          <fieldset class="form-group">

            <legend><?php echo $counter.'. '.$q['title']; ?></legend>
            <input type="hidden" name="<?php echo 'question'.$counter.'_id'; ?>" value="<?php echo $quest['id']; ?>">

            <?php

              if($quest['type'] == 'radio'){

                for ($i = 1; $i <= count($q['answers']); $i++) {
                  ?>
                  <div class="radio_quest">
                    <input type="radio" name="<?php echo 'question'.$counter; ?>" value="<?php echo 'answer'.$i; ?>">
                    <label for="<?php echo $q['answers']['answer'.$i]; ?>"><?php echo $q['answers']['answer'.$i]; ?></label>
                  </div>
                  <?php
                }

              }

              if ($quest['type'] == 'text') {
                ?>
                <div class="text_quest">
                  <input type="text" name="<?php echo 'question'.$counter; ?>" value="" placeholder="Введіть відповідь" autocomplete="off">
                </div>
                <?php
              }

              if ($quest['type'] == 'check') {

                for ($i = 1; $i <= count($q['answers']); $i++){
                  ?>
                  <div class="check_quest">
                    <input type="checkbox" name="<?php echo 'question'.$counter.'_'.$i; ?>" value="<?php echo 'answer'.$i; ?>">
                    <label for="<?php echo $q['answers']['answer'.$i]; ?>"><?php echo $q['answers']['answer'.$i]; ?></label>
                  </div>
                  <?php
                }

              }

            ?>

          </fieldset>

          <?php
          $counter++;
        }

      ?>
      <input id="submit" type="submit" value="Send">

    </form>

  </div>
</body>
</html>
