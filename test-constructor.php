<?php
require 'includes/insert_first_data.php';

if(!$_SESSION['logged_user']){
  $_SESSION['back_page'] = $_SERVER['REQUEST_URI'];
  header('Location: /login.php');
}

if(R::count( 'tests', 'name = ?', array( $_POST['test_title'] ) ) > 0){
  ?>
  <script type="text/javascript">
    localStorage.setItem('Error', 'В базе данных уже имеется данное название теста!');
    history.back();
  </script>
  <?php
  exit();
} else{
  $test = R::dispense('tests');
  $test->name = $_POST['test_title'];
  $test->test_desc = $_POST['test_desc'];
  $test->topics = R::load('topics', $_POST['categorie']);
  R::store($test);
}

if($_POST['test_title'] == ''){
  ?>
  <script type="text/javascript">
    localStorage.setItem('Error', 'Вы не ввели название теста');
    history.back();
  </script>
  <?php
  exit();
}

if($_POST['test_desc'] == ''){
  ?>
  <script type="text/javascript">
    localStorage.setItem('Error', 'Вы не ввели описание теста');
    history.back();
  </script>
  <?php
  exit();
}

$testId = R::getCell('SELECT id FROM tests WHERE name = ?', array($_POST['test_title']));


for ($i = 1; $i <= (count($_POST) - 3) / 3; $i++) {

  $questId = 'quest'.$i;
  $questType = $_POST[$questId.'_type'];
  if(!array_key_exists($questId, $_POST)) break;

  $question = array(
    'title' => $_POST[$questId], 
  );

  if ($questType == 'text') {
    for ($j=1; $j <= count($_POST) - 5; $j++) {

      $variantId = 'q'.$i.'_answer'.$j;
      if(!array_key_exists($variantId, $_POST)) break;

      $question['right_answ'.$j] = $_POST[$variantId];
  
    }
  }
  else if ($questType == 'radio') {
    $question['answers'] = array();
    for ($j=1; $j <= count($_POST) - 5; $j++) {

      $variantId = 'q'.$i.'_answer'.$j;
      if(!array_key_exists($variantId, $_POST)) break;

      $question['answers']['answer'.$j] = $_POST[$variantId];

      if(array_key_exists($variantId.'_right', $_POST))
        $question['right_answ'] = 'answer'.$j;
  
    }
  }
  else if ($questType == 'check') {
    $question['answers'] = array();
    $question['right_answers'] = array();
    for ($j=1; $j <= count($_POST) - 5; $j++) {

      $variantId = 'q'.$i.'_answer'.$j;
      if(!array_key_exists($variantId, $_POST)) break;

      $question['answers']['answer'.$j] = $_POST[$variantId];
  
      if(array_key_exists($variantId.'_right', $_POST))
        array_push($question['right_answers'],'answer'.$j);
        
    }
    
  }

  $thistest = R::load('tests', $testId);
  $newquest = R::dispense('questions');
  $newquest->type = $questType;
  $newquest->quest = json_encode($question);
  $thistest->ownTestList[] = $newquest;
  R::store($thistest);

}
?>
<script type="text/javascript">
localStorage.clear();
window.location = "http://maketestyou.loc/tests.php";
</script>
