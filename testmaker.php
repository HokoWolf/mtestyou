<?php require 'includes/insert_first_data.php'; ?>
<?php
  if(!$_SESSION['logged_user']){
    $_SESSION['back_page'] = $_SERVER['REQUEST_URI'];
    header('Location: /login.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>makeTestyou</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" type="text/css" href="media/css/testmaker.css">
	<link rel="stylesheet" type="text/css" href="media/css/reset.css">
	<link rel="stylesheet" type="text/css" href="media/css/header.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/media/fontawesome/css/all.min.css"></link>

  <script src="/media/js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</head>
<body>
  <?php require "includes/header.php"; ?>
  <div id="wrapper">

    <form action="test-constructor.php" method="POST" id="constrForm">

      <div class="test-header">

          <textarea spellcheck="false" id="test_title" type="text" name="test_title" placeholder="Enter test title" rows="1" maxlength="120"></textarea>

          <textarea spellcheck="false" id="test_desc" name="test_desc" placeholder="Enter test description" rows="1"></textarea>

          <div class="categories">
            <span class="select_desc">Выберите категорию:</span>
            <select size="1" name="categorie">
            <option disabled selected>Категории:</option>
            <?php
            $categories = R::getAll('SELECT `id`, `name` FROM `topics`');
            foreach ($categories as $value) {
              ?>
              <option value='<? echo $value['id']; ?>'><? echo $value['name']; ?></option>
              <?php
            }
            ?>
          </select>
        </div>

      </div> <!--end of test-header-->

      <div class="test-content">

        <div class="quest-form">

          <fieldset class="form-group">

            <legend id="quest1_text" data-id="1" class="quest-text-legend">Текст вопроса номер 1?</legend>

            <div class="radio_quest question">
              <input type="radio" disabled>
              <label id="q1_answer1_label" data-id='1' class="variant-text-label">Вариант 1</label>
            </div>

            <div class="radio_quest question">
              <input type="radio" disabled>
              <label id="q1_answer2_label" data-id='2' class="variant-text-label">Вариант 2</label>
            </div>

          </fieldset>

          <fieldset class="form-group active">

            <input class="radio_quest" type="hidden" name="quest1_type" value="radio"></input>

            <textarea id="quest1" data-id="1" spellcheck="false" class="quest-text" type="text" name="quest1" placeholder="Текст вопроса" rows="1" maxlength="180">Текст вопроса номер 1?</textarea>
            <a class="quest-delete" type="button" title="Delete"><i class="fas fa-trash-alt"></i></a>

            <div class="radio_quest question_const">
              <input type="radio" disabled>
              <label><input id="q1_answer1" data-id='1' class="variant-text" placeholder="Вариант" type="text" name="q1_answer1" value="Вариант 1" style="transform: translate(25px, -36px);"></label>
              <a class="variant-delete" type="button" title="Right answer"><i class="fas fa-trash-alt"></i></a>
              <a class="right right-radio" type="button" title="Right answer"><i class="fas fa-check"></i></a>
            </div>

            <div class="radio_quest question_const">
              <input type="radio" disabled>
              <label><input id="q1_answer2" data-id='2' class="variant-text" placeholder="Вариант" type="text" name="q1_answer2" value="Вариант 2" style="transform: translate(25px, -36px);"></label>
              <a class="variant-delete" type="button" title="Delete answer"><i class="fas fa-trash-alt"></i></a>
              <a class="right right-radio" type="button" title="Right answer"><i class="fas fa-check"></i></a>
            </div>

            <div class="separat" style="margin-top: 30px !important;"></div><hr>

            <div class="points-amount">
              <label for="points1">Points:</label>
              <input type="text" id="points1" name="points1" maxlength="2" pattern="^([1-9]|[1-9][0-9]|100)$" title="Number from 1 till 100">
            </div>

            <button class="add-variant" type="button" name="button" id="addvar1"><span>+</span> Add variant</button>

          </fieldset>

        </div>

        <ul id="add_test_menu">
          <li href="#">
            <a id="add_quest_radio"><i class="fas fa-bullseye" style="margin-right: 10px;"></i>Radio</a>
          </li>
          <li href="#">
            <a id="add_quest_check"><i class="far fa-check-square" style="margin-right: 10px;"></i>Check</a>
          </li>
          <li href="#">
            <a id="add_quest_text"><i class="far fa-text" style="margin-right: 10px;">T</i>Text</a>
          </li>
        </ul>

        <a id="add_test"><span>&#43;</span></a>

        <input id="confirm" type="submit" name="confirm">
      
        <a id="clear" style="cursor: pointer !important;"  title="clear all test"><i class="fas fa-eraser"></i></a>

      </div> <!--end of test-content-->

    </form> <!--end of form -->

  </div> <!--end of wrapper-->


  <script type="text/javascript" src="../media/scripts/header.js"></script>
  <script type="text/javascript">

    function textareaAutosize() {
      let elements = document.querySelectorAll('textarea');
      for (let elem of elements){

        elem.addEventListener('keydown', autosize);
        function autosize(){
          
          var el = this;
          setTimeout(function(){
            el.style.cssText = 'height:auto; padding:0';
            el.style.cssText = 'height:' + el.scrollHeight + 'px';
          },0);
        }
      }
    }
    textareaAutosize();

    window.addEventListener('load', () => {
      if(localStorage.getItem('nativePage') == 'undefined' || localStorage.getItem('nativePage') == null){
        localStorage.setItem('nativePage', document.getElementById('constrForm').innerHTML);
      }
      if(localStorage.getItem('constrPage') != 'undefined' && localStorage.getItem('constrPage') != null){
        document.getElementById('constrForm').innerHTML = localStorage.getItem('constrPage');
        textareaAutosize();
        let textareas = document.querySelectorAll('textarea');
        for (let i = 0; i < textareas.length; i++) {
          textareas[i].value = localStorage.getItem(textareas[i].id);
          localStorage.removeItem(textareas[i]);
        }
        let inputs = document.querySelectorAll('input[type="text"]');
        for (let i = 0; i < inputs.length; i++) {
          inputs[i].value = localStorage.getItem(inputs[i].id);
          localStorage.removeItem(inputs[i]);
        }
        localStorage.removeItem('constrPage');
      }
    });

    window.addEventListener('unload', () => {
      localStorage.removeItem('constrPage');
      localStorage.setItem('constrPage', document.getElementById('constrForm').innerHTML);
      let textareas = document.querySelectorAll('textarea');
      for (let i = 0; i < textareas.length; i++) {
        localStorage.removeItem(textareas[i]);
        localStorage.setItem(textareas[i].id, textareas[i].value);
      }
      let inputs = document.querySelectorAll('input[type="text"]');
      for (let i = 0; i < inputs.length; i++) {
        localStorage.removeItem(inputs[i]);
        localStorage.setItem(inputs[i].id, inputs[i].value);
      }
      
      localStorage.setItem('counterLength', ($('.quest-form').length + 1));

      let el = document.getElementsByClassName('quest-form');

      for(let i = 0; i < el.length; i++){

        var variantsCount = 0;
        
        if(i == 0) {
          let r = el[i].childNodes[1];
          for (let j = 1; j < r.childNodes.length; j+=2){
            if(r.childNodes[j].classList.contains('question'))
              variantsCount++;
          }
        }
        else {
          let r2 = el[i].childNodes[0];
          for (let j = 0; j < r2.childNodes.length; j++){
            if(r2.childNodes[j].classList.contains('question'))
              variantsCount++;
          }
        }
        localStorage.setItem(i, variantsCount + 1);
      }
      
      localStorage.setItem(($('.quest-form').length), 2);
    });

    $('body').on('click', '#clear', function () {
      var clearConfirmation = confirm('Вы точно хотите очистить тест?');
      if (clearConfirmation) {
        var nativeForm = localStorage.getItem('nativePage');
        localStorage.clear();
        location.reload();
        document.getElementById('constrForm').innerHTML = nativeForm;
        localStorage.setItem('nativePage', nativeForm);
      }
    });
      
    $('body').on('click', '#confirm', function () {
      if (confirm("Вы хотите закончить тест и опубликовать его?")) {
        return true;
      } else {
        return false;
      }
    });
    

  </script>
  <script type="text/javascript" src="media/js/testmaker.js"></script>
  

</body>
</html>