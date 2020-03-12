<?php
  require('../includes/insert_first_data.php');
  $test_id = $_POST['checked_test_id'];
  $result = 0;
  $right_result = 0;
  $total_questions = R::count('questions', 'tests_id = ?', [$test_id]);
  $quests = R::getall('SELECT * FROM `questions` WHERE `tests_id` = ?', [ $test_id ]);
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

  <?php require('../includes/header.php'); ?>

  <div class="wrapper">
  <div class="test-header">
    <h1 class="test-title">Ваші відповіді</h1>
  </div>
  <div class="test">

    <form>

      <?php

        $counter = 1;
        foreach ($quests as $quest) {
          $q_i = 'question'.$counter.'_id';
          $q_a = 'question'.$counter;
          $q = json_decode($quest['quest'], true);
          ?>

          <fieldset class="form-group">

            <legend><?php echo $counter.'. '.$q['title']; ?></legend>

            <input type="hidden" name="<?php echo 'question'.$counter.'_id'; ?>" value="<?php echo $quest['id']; ?>">

            <?php

              if($quest['type'] == 'radio'){

                for ($i = 1; $i <= count($q['answers']); $i++) {

                  $question = $q['right_answ'];

                  if(!key_exists($q_a, $_POST)){
                    if ('answer'.$i == $question) {
                      ?>
                      <div class="radio_quest">
                        <input style="cursor: auto;" type="radio" name="<?php echo 'question'.$counter; ?>" value="<?php echo 'answer'.$i; ?>" disabled>
                        <label style="cursor: context-menu; padding: 6px; background-color: rgb(33, 166, 50); width: 100px; color: white;" for="<?php echo $quest['answer'.$i]; ?>"><?php echo $q['answers']['answer'.$i]; ?></label>
                      </div>
                      <?php
                    } else {
                      ?>
                      <div class="radio_quest">
                        <input style="cursor: auto;" type="radio" name="<?php echo 'question'.$counter; ?>" value="<?php echo 'answer'.$i; ?>" disabled>
                        <label style="cursor: context-menu;" for="<?php echo $quest['answer'.$i]; ?>"><?php echo $q['answers']['answer'.$i]; ?></label>
                      </div>
                      <?php
                    }
                  } else{
                    if('answer'.$i == $_POST[$q_a] && $question == $_POST[$q_a]){
                      ?>
                      <div class="radio_quest">
                        <input style="cursor: auto;" type="radio" name="<?php echo 'question'.$counter; ?>" value="<?php echo 'answer'.$i; ?>" checked disabled>
                        <label style="cursor: context-menu; padding: 6px; background-color: rgb(33, 166, 50); color: white;" for="<?php echo $quest['answer'.$i]; ?>"><?php echo $q['answers']['answer'.$i]; ?></label>
                      </div>
                      <?php
                      $right_result++;
                    } else if ('answer'.$i == $_POST[$q_a] && $question != $_POST[$q_a]) {
                      ?>
                      <div class="radio_quest">
                        <input style="cursor: auto;" type="radio" name="<?php echo 'question'.$counter; ?>" value="<?php echo 'answer'.$i; ?>" checked disabled>
                        <label style="cursor: context-menu; padding: 6px; background-color: rgb(166, 33, 33); color: white;" for="<?php echo $quest['answer'.$i]; ?>"><?php echo $q['answers']['answer'.$i]; ?></label>
                      </div>
                      <?php
                    } else if ('answer'.$i == $question) {
                      ?>
                      <div class="radio_quest">
                        <input style="cursor: auto;" type="radio" name="<?php echo 'question'.$counter; ?>" value="<?php echo 'answer'.$i; ?>" disabled>
                        <label style="cursor: context-menu; padding: 6px; background-color: rgb(33, 166, 50); width: 100px; color: white;" for="<?php echo $quest['answer'.$i]; ?>"><?php echo $q['answers']['answer'.$i]; ?></label>
                      </div>
                      <?php
                    } else{
                      ?>
                      <div class="radio_quest">
                        <input style="cursor: auto;" type="radio" name="<?php echo 'question'.$counter; ?>" value="<?php echo 'answer'.$i; ?>" disabled>
                        <label style="cursor: context-menu;" for="<?php echo $quest['answer'.$i]; ?>"><?php echo $q['answers']['answer'.$i]; ?></label>
                      </div>
                      <?php
                    }
                  }
                }
              }

              if ($quest['type'] == 'text') {

                $question = $q['right_answ'];

                if ($q['right_answ'] == $_POST[$q_a]) {
                  ?>
                  <div class="text_quest">
                    <input type="text" name="<?php echo 'question'.$counter; ?>" value="<?php echo $_POST[$q_a]; ?>" placeholder="Введіть відповідь" disabled>
                    <p style="color: green; margin: 20px; font-weight: bold;">Правильна відповідь!</p>
                  </div>
                  <?php
                  $right_result++;
                }
                else {
                  ?>
                  <div class="text_quest">
                    <input type="text" name="<?php echo 'question'.$counter; ?>" value="<?php echo $_POST[$q_a]; ?>" placeholder="Введіть відповідь" disabled>
                    <p style="color: green; margin: 20px; font-weight: bold;">Відповідь не вірна!</p>
                    <p style="color: red; margin: 20px; font-weight: bold;">Правильна відповідь - <?php echo $q['right_answ']; ?></p>
                  </div>
                  <?php
                }

              }

              if ($quest['type'] == 'check') {

                $question = $q['right_answers'];

                $check_res = 0;

                for ($i = 1; $i <= count($q['answers']); $i++){

                  $q_a_ch = $q_a.'_'.$i;

                  if(!key_exists($q_a_ch, $_POST)){
                    if (in_array('answer'.$i, $q['right_answers'])){
                      ?>
                      <div class="check_quest">
                        <input style="cursor: context-menu;" type="checkbox" name="<?php echo 'question'.$counter; ?>" value="<?php echo 'answer'.$i; ?>"  disabled>
                        <label style="cursor: context-menu; padding: 6px; background-color: rgb(33, 166, 50); color: white;" for="<?php echo $q['answers']['answer'.$i]; ?>"><?php echo $q['answers']['answer'.$i]; ?></label>
                      </div>
                      <?php
                    }
  
                    else{
                      ?>
                      <div class="check_quest">
                        <input style="cursor: context-menu;" type="checkbox" name="<?php echo 'question'.$counter; ?>" value="<?php echo 'answer'.$i; ?>" disabled>
                        <label style="cursor: context-menu;" for="<?php echo $q['answers']['answer'.$i]; ?>"><?php echo $q['answers']['answer'.$i]; ?></label>
                      </div>
                      <?php
                    }
                  } else {
                    if('answer'.$i == $_POST[$q_a_ch] && in_array($_POST[$q_a_ch], $q['right_answers'])){
                      ?>
                      <div class="check_quest">
                        <input style="cursor: context-menu;" type="checkbox" name="<?php echo 'question'.$counter; ?>" value="<?php echo 'answer'.$i; ?>" checked disabled>
                        <label style="cursor: context-menu; padding: 6px; background-color: rgb(33, 166, 50); color: white;" for="<?php echo $q['answers']['answer'.$i]; ?>"><?php echo $q['answers']['answer'.$i]; ?></label>
                      </div>
                      <?php
                      $check_res++;
                    }
  
                    else if ('answer'.$i == $_POST[$q_a_ch] && in_array($_POST[$q_a_ch], $q['right_answers']) == false){
                      ?>
                      <div class="check_quest">
                        <input style="cursor: context-menu;" type="checkbox" name="<?php echo 'question'.$counter; ?>" value="<?php echo 'answer'.$i; ?>" checked disabled>
                        <label style="cursor: context-menu;  padding: 6px; background-color: rgb(166, 33, 33); color: white;" for="<?php echo $q['answers']['answer'.$i]; ?>"><?php echo $q['answers']['answer'.$i]; ?></label>
                      </div>
                      <?php
                    }
  
                    else if (in_array('answer'.$i, $q['right_answers'])){
                      ?>
                      <div class="check_quest">
                        <input style="cursor: context-menu;" type="checkbox" name="<?php echo 'question'.$counter; ?>" value="<?php echo 'answer'.$i; ?>"  disabled>
                        <label style="cursor: context-menu; padding: 6px; background-color: rgb(33, 166, 50); color: white;" for="<?php echo $q['answers']['answer'.$i]; ?>"><?php echo $q['answers']['answer'.$i]; ?></label>
                      </div>
                      <?php
                    }
  
                    else{
                      ?>
                      <div class="check_quest">
                        <input style="cursor: context-menu;" type="checkbox" name="<?php echo 'question'.$counter; ?>" value="<?php echo 'answer'.$i; ?>" disabled>
                        <label style="cursor: context-menu;" for="<?php echo $q['answers']['answer'.$i]; ?>"><?php echo $q['answers']['answer'.$i]; ?></label>
                      </div>
                      <?php
                    }
                  }
                }

                if($check_res == count($q['right_answers'])){
                  $right_result++;
                }

              }

            ?>

          </fieldset>

          <?php
          $counter++;
        }

      ?>

    </form>

    <div class="result"><p><?php echo 'Ваш результат: '.$right_result.' из '.$total_questions; ?></p></div>

    <a class="go_to_cat" href="../tests.php?cat_id=0">Test you</a>

  </div>

</body>
</html>
