// global variable that shows amount of questions and quentity of answers in each question
// counter.length - amount of questions
// counter[i] - next number of answer in question with index i
// counter_default = [3, 2]
var counter = [];
function setCounter (counter) {
  for (let i = 0; i < localStorage.getItem('counterLength'); i++) {
    counter[i] = parseInt(localStorage.getItem(i));
  }
  return counter;
}
counter = setCounter(counter);
if(counter.length == 0)
  counter = [3, 2];

$(document).ready(function () {
  if(localStorage.getItem('Error') != null){
    alert(localStorage.getItem('Error'));
    localStorage.removeItem('Error');
  }
});

$('.form-group.active').hide();

// change outline and border in textarea during and after changing
$("#test_title").change(function(){

  var test_title = document.getElementById('test_title');
  if (test_title.value.length == 0) $("#test_title").css("border", "1px solid #A9A9A9");
  if (test_title.value !== '') $("#test_title").css("border", "none");
});

$("#test_desc").change(function(){

  var test_desc = document.getElementById('test_desc');
  if (test_desc.value.length == 0) $("#test_desc").css("border", "1px solid #A9A9A9");
  if (test_desc.value !== '') $("#test_desc").css("border", "none");
});
  
// textarea autosize
/*function textareaAutosize() {
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
textareaAutosize();*/


// change question from user view to constructor view
$('body').on('click', '.form-group:not(.active)', function(){
  $(this).hide();          // hiding user view div
  $(this).next().show();   // showing constructor view div
});

// change question from constructor view to user view
$(function($){
  $(document).mouseup(function (e){           // clicking on web document action
    var div = $(".form-group.active");        // setting element`s id
    if (!div.is(e.target)                     // if click was not on our question
        && div.has(e.target).length === 0) {  // and not for his children elements
      div.hide();                             // hide this
      $('.form-group').not('.active').show(); // and show user view div
    }
  });
});

// sending text legend from input to user view after changing
$('body').on('change', '.quest-text', function(){
  var id = $(this).data('id');           // taking constructor view legend`s data-id
  var leg = '#quest';
  var legend = leg.concat(id, '_text');  // user view legend
  var txt = '';
  var text = txt.concat($(this).val());  // ledend`s input value (text)
  $(legend).text(text);                  // sending text to user vies legend
});

// sending label text from input to user view (label) after changing
$('body').on('change', '.variant-text', function(){
  var id = $(this).attr('id');         // id of changing variant`s input
  var label = '#';
  label = label.concat(id, '_label');  // id of corresponding label to changing variant`s input
  var text = $(this).val();            // value of changing variant`s input (text)
  $(label).text(text);                 // sending this text to label
});



// variant deleting
$('body').on('click', '.variant-delete', function () {

  var type = this.parentElement;

  if($(type).hasClass('text_quest')){
    var text = '';
    var id = this.previousElementSibling.id;
    var value = this.previousElementSibling.value;
    text = text.concat('<span id="', id, '_label">', value, '</span>');

    var el = this.parentElement.parentElement.previousElementSibling.children[this.parentElement.parentElement.previousElementSibling.children.length - 1];
    var html = el.innerHTML;
    html = html.replace(text, '');
    html = html.replace(', ', '')
    el.innerHTML = html;
  } else {
    var $el = $(this).prev().children();
    var id = '#';
    id = id.concat($el.attr('id'), '_label');
    $(id).parent().remove();
  }

  $(this).parent().remove();
});

// quest deleting
$('body').on('click', '.quest-delete', function() {
  $(this).parent().parent().remove();
});



// right answer changing
$('body').on('click', '.right-radio', function() {
  var el_id = (((this.previousElementSibling).previousElementSibling).children[0]).id;
  var text = ''
  text = text.concat('#', el_id, '_label');
  var dop_el_id = el_id.concat('_right');
  el_id = text;
  var removes1 = this.parentElement.parentElement.previousElementSibling;
  var removes2 = this.parentElement.parentElement;
  if($(this).hasClass('r-check')){
    $(this).toggleClass('r-check');
    $(el_id).next().remove();
    $(el_id).next().remove();
  } else {
    $(removes1).children('.question').children('.right-radio').removeClass('r-check');/* here */
    $(removes2).children('.question_const').children('.right-radio').removeClass('r-check');/* here */
    $(this).toggleClass('r-check');
    $(removes1).children('.question').children('.right-show').next().remove();/* here */
    $(removes1).children('.question').children('.right-show').remove();/* here */
    var t = '';
    t = t.concat('<input type="hidden" name="', dop_el_id, '" value="true">');
    $(el_id).after(t);
    $(el_id).after('<a class="right-show" type="button" title="Right answer"><i class="fas fa-check"></i></a>');
  }
});
$('body').on('click', '.right-check', function() {
  var el_id = (((this.previousElementSibling).previousElementSibling).children[0]).id;
  var text = '';
  text = text.concat('#', el_id, '_label');
  var dop_el_id = el_id.concat('_right');
  el_id = text;
  var removes1 = this.parentElement.parentElement.previousElementSibling;
  var removes2 = this.parentElement.parentElement;

  if($(this).hasClass('r-check')){
    $(this).toggleClass('r-check');
    $(el_id).next().remove();
    $(el_id).next().remove();
  } else {
    $(this).toggleClass('r-check');
    var t = '';
    t = t.concat('<input type="hidden" name="', dop_el_id, '" value="true">');
    $(el_id).after(t);
    $(el_id).after('<a class="right-show" type="button" title="Right answer"><i class="fas fa-check"></i></a>');
  }
});
// adding new variant
$('body').on('click', '.add-variant', function(){

  var par = this.parentElement;
  var q = par.children[1].dataset.id;
  var quest = this.parentElement.children[0];

  if($(quest).hasClass('text_quest')){

    //         constructor

    var r = par.children[par.children.length - 5];
    var id1 = '';
    id1 = id1.concat('q', q, '_answer', counter[q - 1]);

    var div_constr = document.createElement('div');
    div_constr.classList.add('text_quest');
    div_constr.classList.add('question_const');
    div_constr.classList.add('tt');
    r.after(div_constr);

    var text_input = document.createElement('input');
    text_input.id = id1;
    text_input.dataset.id = counter[q - 1];
    text_input.classList.add('variant-text');
    text_input.classList.add('t');
    text_input.setAttribute('placeholder', 'Вариант');
    text_input.setAttribute('type', 'text');
    text_input.setAttribute('name', id1);
    text_input.value = 'Вариант';
    text_input.setAttribute('autocomplete', 'off');
    div_constr.append(text_input);

    var var_del = document.createElement('a');
    var_del.classList.add('variant-delete');
    var_del.classList.add('td');
    var_del.setAttribute('type', 'button');
    var_del.setAttribute('title', 'Delete answer');
    div_constr.append(var_del);

    var var_del_ico = document.createElement('i');
    var_del_ico.classList.add('fas');
    var_del_ico.classList.add('fa-trash-alt');
    var_del.append(var_del_ico);

    // user view

    var r2 = par.previousElementSibling.children[par.previousElementSibling.children.length - 1];
    var id2 = '';
    id2 = id2.concat(id1, '_label');
    var t = '';
    t = t.concat(', <span id="', id2, '">Вариант</span>');
    r2.innerHTML += t;

  } else {

    var quest_type = '';
    var t = '';
    if($(quest).hasClass('radio_quest'))
        quest_type = 'radio';
    if($(quest).hasClass('check_quest'))
        quest_type = 'check';

    //      constructor

    var r = par.children[par.children.length - 5];
    var id1 = '';
    id1 = id1.concat('q', q, '_answer', counter[q - 1]);;

    var div_constr = document.createElement('div');
    t = '';
    t = t.concat(quest_type, '_quest');
    div_constr.classList.add(t);
    div_constr.classList.add('question_const');
    r.after(div_constr);

    var rad_input = document.createElement('input');
    if(quest_type == 'check')
      rad_input.setAttribute('type', 'checkbox');
    else
      rad_input.setAttribute('type', quest_type);
    rad_input.disabled = true;
    div_constr.append(rad_input);

    var label_constr = document.createElement('label');
    div_constr.append(label_constr);

    var label_input = document.createElement('input');
    label_input.id = id1;
    label_input.dataset.id = counter[q - 1];
    label_input.classList.add('variant-text');
    label_input.setAttribute('placeholder', 'Вариант');
    label_input.setAttribute('type', 'text');
    label_input.setAttribute('name', id1);
    label_input.value = "Вариант";
    label_input.setAttribute('autocomplete', 'off');
    label_constr.append(label_input);

    var var_del = document.createElement('a');
    var_del.classList.add('variant-delete');
    var_del.setAttribute('type', 'button');
    var_del.setAttribute('title', 'Delete answer');
    div_constr.append(var_del);

    var var_del_ico = document.createElement('i');
    var_del_ico.classList.add('fas');
    var_del_ico.classList.add('fa-trash-alt');
    var_del.append(var_del_ico);

    var var_right_answ = document.createElement('a');
    var_right_answ.classList.add('right');
    t = '';
    t = t.concat('right-', quest_type);
    var_right_answ.classList.add(t);
    var_right_answ.setAttribute('type', 'button');
    var_right_answ.setAttribute('title', 'Right answer');
    div_constr.append(var_right_answ);

    var var_del_ico = document.createElement('i');
    var_del_ico.classList.add('fas');
    var_del_ico.classList.add('fa-check');
    var_right_answ.append(var_del_ico);



    //    user view

    var r2 = par.previousElementSibling.children[par.previousElementSibling.children.length - 1];
    var id2 = '';
    id2 = id2.concat(id1, '_label');

    var div_user = document.createElement('div');
    t = '';
    t = t.concat(quest_type, '_quest');
    div_user.classList.add(t);
    div_user.classList.add('question');
    r2.after(div_user);

    var rad_input_user = document.createElement('input');
    if(quest_type == 'check')
      rad_input_user.setAttribute('type', 'checkbox');
    else
      rad_input_user.setAttribute('type', quest_type);
    rad_input_user.disabled = true;
    div_user.append(rad_input_user);

    var label_user = document.createElement('label');
    label_user.id = id2;
    label_user.dataset.id = counter[q - 1];
    label_user.innerHTML = 'Вариант';
    label_user.classList.add('variant-text-label');
    div_user.append(label_user);

  }

  //   after adding new variant
  counter[q - 1]++;
});

// adding new question
$('body').on('click', '#add_test', function () {

  if ($('#add_test_menu').css('display') == 'none')
    $('#add_test_menu').css('display', 'block');
  else
    $('#add_test_menu').css('display', 'none');
});
$(function($){
  $(document).mouseup(function (e){           // clicking on web document action
    var menu = $("#add_test_menu");        // setting element`s id
    if (!menu.is(e.target)                     // if click was not on our question
        && menu.has(e.target).length === 0) {  // and not for his children elements
      menu.hide();                             // hide this
    }
  });
});

// adding radio question
$('body').on('click', '#add_quest_radio', function () {
  $('#add_test_menu').css('display', 'none');
  var par = this.parentElement.parentElement;
  var q = counter.length;

  var legendInputId = '';
  legendInputId = legendInputId.concat('quest', q);
  var legendId = '';
  legendId = legendId.concat('quest', q, '_text');
  var labelInputId = '';
  labelInputId = labelInputId.concat('q', q, '_answer1');
  var labelUserId = labelInputId.concat('_label');
  var addVariantId = '';
  addVariantId = addVariantId.concat('addvar', q);
  var pointsId = '';
  pointsId = pointsId.concat('points', q);

  var newQuest = document.createElement('div');
  newQuest.classList.add('quest-form');
  par.before(newQuest);

  var formGroup = document.createElement('fieldset');
  formGroup.classList.add('form-group');
  newQuest.append(formGroup);

  var userLegend = document.createElement('legend');
  userLegend.id = legendId;
  userLegend.dataset.id = q;
  userLegend.classList.add('quest-text-legend');
  userLegend.innerHTML = 'Вопрос';
  formGroup.append(userLegend);

  var newUserVariant = document.createElement('div');
  newUserVariant.classList.add('radio_quest');
  newUserVariant.classList.add('question');
  formGroup.append(newUserVariant);

  var userDisabledRadio = document.createElement('input');
  userDisabledRadio.setAttribute('type', 'radio');
  userDisabledRadio.disabled = true;
  newUserVariant.append(userDisabledRadio);

  var userVariantLabel = document.createElement('label');
  userVariantLabel.id = labelUserId;
  userVariantLabel.dataset.id = '1';
  userVariantLabel.classList.add('variant-text-label');
  userVariantLabel.innerHTML = 'Вариант';
  newUserVariant.append(userVariantLabel);

  var formGroupActive = document.createElement('fieldset');
  formGroupActive.classList.add('form-group');
  formGroupActive.classList.add('active');
  newQuest.append(formGroupActive);

  var qt = document.createElement('input');
  qt.classList.add('radio_quest');
  qt.setAttribute('type', 'hidden');
  var qtype = legendInputId.concat('_type');
  qt.setAttribute('name', qtype);
  qt.setAttribute('value', 'radio');
  formGroupActive.append(qt);

  var legendInput = document.createElement('textarea');
  legendInput.id = legendInputId;
  legendInput.dataset.id = q;
  legendInput.setAttribute('spellcheck', 'false');
  legendInput.classList.add('quest-text');
  legendInput.setAttribute('type', 'text');
  legendInput.setAttribute('name', legendInputId);
  legendInput.setAttribute('placeholder', 'Вопрос');
  legendInput.setAttribute('rows', '1');
  legendInput.setAttribute('maxlength', '180');
  legendInput.innerHTML = 'Вопрос';
  formGroupActive.append(legendInput);

  var questDelete = document.createElement('a');
  questDelete.classList.add('quest-delete');
  questDelete.setAttribute('type', 'button');
  questDelete.setAttribute('title', 'Delete');
  formGroupActive.append(questDelete);

  var questDeleteIcon = document.createElement('i');
  questDeleteIcon.classList.add('fas');
  questDeleteIcon.classList.add('fa-trash-alt');
  questDelete.append(questDeleteIcon);

  var constrVariant = document.createElement('div');
  constrVariant.classList.add('radio_quest');
  constrVariant.classList.add('question_const');
  formGroupActive.append(constrVariant);

  var constrDisabledRadio = document.createElement('input');
  constrDisabledRadio.setAttribute('type', 'radio');
  constrDisabledRadio.disabled = true;
  constrVariant.append(constrDisabledRadio);

  var constrVariantLabel = document.createElement('label');
  constrVariant.append(constrVariantLabel);

  var variantInput = document.createElement('input');
  variantInput.id = labelInputId;
  variantInput.dataset.id = '1';
  variantInput.classList.add('variant-text');
  variantInput.setAttribute('placeholder', 'Вариант');
  variantInput.setAttribute('type', 'text');
  variantInput.setAttribute('name', labelInputId);
  variantInput.value = 'Вариант';
  constrVariantLabel.append(variantInput);

  var var_del = document.createElement('a');
  var_del.classList.add('variant-delete');
  var_del.setAttribute('type', 'button');
  var_del.setAttribute('title', 'Delete answer');
  constrVariant.append(var_del);

  var var_del_ico = document.createElement('i');
  var_del_ico.classList.add('fas');
  var_del_ico.classList.add('fa-trash-alt');
  var_del.append(var_del_ico);

  var var_right_answ = document.createElement('a');
  var_right_answ.classList.add('right');
  var_right_answ.classList.add('right-radio');
  var_right_answ.setAttribute('type', 'button');
  var_right_answ.setAttribute('title', 'Right answer');
  constrVariant.append(var_right_answ);

  var var_check_ico = document.createElement('i');
  var_check_ico.classList.add('fas');
  var_check_ico.classList.add('fa-check');
  var_right_answ.append(var_check_ico);

  var separat = document.createElement('div');
  separat.classList.add('separat');
  separat.setAttribute('style', 'margin-top: 30px !important;');
  formGroupActive.append(separat);

  var hr = document.createElement('hr');
  formGroupActive.append(hr);

  var pointsAmount = document.createElement('div');
  pointsAmount.classList.add('points-amount');
  formGroupActive.append(pointsAmount);

  var labelForPoints = document.createElement('label');
  labelForPoints.setAttribute('for', pointsId);
  labelForPoints.innerHTML = 'Points:';
  pointsAmount.append(labelForPoints);

  var pointsInput = document.createElement('input');
  pointsInput.setAttribute('type', 'text');
  pointsInput.setAttribute('name', pointsId);
  pointsInput.id = pointsId;
  pointsInput.setAttribute('maxlength', '2');
  pointsInput.setAttribute('pattern', '^([1-9]|[1-9][0-9]|100)$');
  pointsInput.setAttribute('title', 'Number from 1 till 100');
  pointsAmount.append(pointsInput);

  var addNewVariant = document.createElement('button');
  addNewVariant.classList.add('add-variant');
  addNewVariant.setAttribute('type', 'button');
  addNewVariant.setAttribute('name', 'button');
  addNewVariant.id = addVariantId;
  addNewVariant.innerHTML = "<span>+</span> Add variant";
  formGroupActive.append(addNewVariant);

  // after adding new question
  counter.push(2);
  $(formGroup).hide();
  textareaAutosize();
});

// adding check question
$('body').on('click', '#add_quest_check', function () {
  $('#add_test_menu').css('display', 'none');
  var par = this.parentElement.parentElement;
  var q = counter.length;

  var legendInputId = '';
  legendInputId = legendInputId.concat('quest', q);
  var legendId = '';
  legendId = legendId.concat('quest', q, '_text');
  var labelInputId = '';
  labelInputId = labelInputId.concat('q', q, '_answer1');
  var labelUserId = labelInputId.concat('_label');
  var addVariantId = '';
  addVariantId = addVariantId.concat('addvar', q);
  var pointsId = '';
  pointsId = pointsId.concat('points', q);

  var newQuest = document.createElement('div');
  newQuest.classList.add('quest-form');
  par.before(newQuest);

  var formGroup = document.createElement('fieldset');
  formGroup.classList.add('form-group');
  newQuest.append(formGroup);

  var userLegend = document.createElement('legend');
  userLegend.id = legendId;
  userLegend.dataset.id = q;
  userLegend.classList.add('quest-text-legend');
  userLegend.innerHTML = 'Вопрос';
  formGroup.append(userLegend);

  var newUserVariant = document.createElement('div');
  newUserVariant.classList.add('check_quest');
  newUserVariant.classList.add('question');
  formGroup.append(newUserVariant);

  var userDisabledRadio = document.createElement('input');
  userDisabledRadio.setAttribute('type', 'checkbox');
  userDisabledRadio.disabled = true;
  newUserVariant.append(userDisabledRadio);

  var userVariantLabel = document.createElement('label');
  userVariantLabel.id = labelUserId;
  userVariantLabel.dataset.id = '1';
  userVariantLabel.classList.add('variant-text-label');
  userVariantLabel.innerHTML = 'Вариант';
  newUserVariant.append(userVariantLabel);

  var formGroupActive = document.createElement('fieldset');
  formGroupActive.classList.add('form-group');
  formGroupActive.classList.add('active');
  newQuest.append(formGroupActive);

  var qt = document.createElement('input');
  qt.classList.add('check_quest');
  qt.setAttribute('type', 'hidden');
  var qtype = legendInputId.concat('_type');
  qt.setAttribute('name', qtype);
  qt.setAttribute('value', 'check');
  formGroupActive.append(qt);

  var legendInput = document.createElement('textarea');
  legendInput.id = legendInputId;
  legendInput.dataset.id = q;
  legendInput.setAttribute('spellcheck', 'false');
  legendInput.classList.add('quest-text');
  legendInput.setAttribute('type', 'text');
  legendInput.setAttribute('name', legendInputId);
  legendInput.setAttribute('placeholder', 'Вопрос');
  legendInput.setAttribute('rows', '1');
  legendInput.setAttribute('maxlength', '180');
  legendInput.innerHTML = 'Вопрос';
  formGroupActive.append(legendInput);

  var questDelete = document.createElement('a');
  questDelete.classList.add('quest-delete');
  questDelete.setAttribute('type', 'button');
  questDelete.setAttribute('title', 'Delete');
  formGroupActive.append(questDelete);

  var questDeleteIcon = document.createElement('i');
  questDeleteIcon.classList.add('fas');
  questDeleteIcon.classList.add('fa-trash-alt');
  questDelete.append(questDeleteIcon);

  var constrVariant = document.createElement('div');
  constrVariant.classList.add('check_quest');
  constrVariant.classList.add('question_const');
  formGroupActive.append(constrVariant);

  var constrDisabledRadio = document.createElement('input');
  constrDisabledRadio.setAttribute('type', 'checkbox');
  constrDisabledRadio.disabled = true;
  constrVariant.append(constrDisabledRadio);

  var constrVariantLabel = document.createElement('label');
  constrVariant.append(constrVariantLabel);

  var variantInput = document.createElement('input');
  variantInput.id = labelInputId;
  variantInput.dataset.id = '1';
  variantInput.classList.add('variant-text');
  variantInput.setAttribute('placeholder', 'Вариант');
  variantInput.setAttribute('type', 'text');
  variantInput.setAttribute('name', labelInputId);
  variantInput.value = 'Вариант';
  constrVariantLabel.append(variantInput);

  var var_del = document.createElement('a');
  var_del.classList.add('variant-delete');
  var_del.setAttribute('type', 'button');
  var_del.setAttribute('title', 'Delete answer');
  constrVariant.append(var_del);

  var var_del_ico = document.createElement('i');
  var_del_ico.classList.add('fas');
  var_del_ico.classList.add('fa-trash-alt');
  var_del.append(var_del_ico);

  var var_right_answ = document.createElement('a');
  var_right_answ.classList.add('right');
  var_right_answ.classList.add('right-check');
  var_right_answ.setAttribute('type', 'button');
  var_right_answ.setAttribute('title', 'Right answer');
  constrVariant.append(var_right_answ);

  var var_check_ico = document.createElement('i');
  var_check_ico.classList.add('fas');
  var_check_ico.classList.add('fa-check');
  var_right_answ.append(var_check_ico);

  var separat = document.createElement('div');
  separat.classList.add('separat');
  separat.setAttribute('style', 'margin-top: 30px !important;');
  formGroupActive.append(separat);

  var hr = document.createElement('hr');
  formGroupActive.append(hr);

  var pointsAmount = document.createElement('div');
  pointsAmount.classList.add('points-amount');
  formGroupActive.append(pointsAmount);

  var labelForPoints = document.createElement('label');
  labelForPoints.setAttribute('for', pointsId);
  labelForPoints.innerHTML = 'Points:';
  pointsAmount.append(labelForPoints);

  var pointsInput = document.createElement('input');
  pointsInput.setAttribute('type', 'text');
  pointsInput.setAttribute('name', pointsId);
  pointsInput.id = pointsId;
  pointsInput.setAttribute('maxlength', '2');
  pointsInput.setAttribute('pattern', '^([1-9]|[1-9][0-9]|100)$');
  pointsInput.setAttribute('title', 'Number from 1 till 100');
  pointsAmount.append(pointsInput);

  var addNewVariant = document.createElement('button');
  addNewVariant.classList.add('add-variant');
  addNewVariant.setAttribute('type', 'button');
  addNewVariant.setAttribute('name', 'button');
  addNewVariant.id = addVariantId;
  addNewVariant.innerHTML = "<span>+</span> Add variant";
  formGroupActive.append(addNewVariant);

  // after adding new question
  counter.push(2);
  $(formGroup).hide();
  textareaAutosize();
});

// adding text question
$('body').on('click', '#add_quest_text', function () {
  $('#add_test_menu').css('display', 'none');
  var par = this.parentElement.parentElement;
  var q = counter.length;

  var legendInputId = '';
  legendInputId = legendInputId.concat('quest', q);
  var legendId = '';
  legendId = legendId.concat('quest', q, '_text');
  var labelInputId = '';
  labelInputId = labelInputId.concat('q', q, '_answer1');
  var labelUserId = labelInputId.concat('_label');
  var addVariantId = '';
  addVariantId = addVariantId.concat('addvar', q);
  var pointsId = '';
  pointsId = pointsId.concat('points', q);

  var newQuest = document.createElement('div');
  newQuest.classList.add('quest-form');
  par.before(newQuest);

  var formGroup = document.createElement('fieldset');
  formGroup.classList.add('form-group');
  newQuest.append(formGroup);

  var userLegend = document.createElement('legend');
  userLegend.id = legendId;
  userLegend.dataset.id = q;
  userLegend.classList.add('quest-text-legend');
  userLegend.innerHTML = 'Вопрос';
  formGroup.append(userLegend);

  var newUserVariant = document.createElement('div');
  newUserVariant.classList.add('text_quest');
  newUserVariant.classList.add('question');
  formGroup.append(newUserVariant);

  var userDisabledInput = document.createElement('input');
  userDisabledInput.setAttribute('type', 'text');
  userDisabledInput.disabled = true;
  userDisabledInput.setAttribute('placeholder', 'Введите ответ');
  newUserVariant.append(userDisabledInput);

  var rightAnswers = document.createElement('span');
  var t = '';
  t = t.concat('<strong>Правильные ответы:</strong> <span id="', labelUserId, '">Вариант</span>');
  rightAnswers.innerHTML = t;
  newUserVariant.append(rightAnswers);

  var formGroupActive = document.createElement('fieldset');
  formGroupActive.classList.add('form-group');
  formGroupActive.classList.add('active');
  newQuest.append(formGroupActive);

  var qt = document.createElement('input');
  qt.classList.add('text_quest');
  qt.setAttribute('type', 'hidden');
  var qtype = legendInputId.concat('_type');
  qt.setAttribute('name', qtype);
  qt.setAttribute('value', 'text');
  formGroupActive.append(qt);

  var legendInput = document.createElement('textarea');
  legendInput.id = legendInputId;
  legendInput.dataset.id = q;
  legendInput.setAttribute('spellcheck', 'false');
  legendInput.classList.add('quest-text');
  legendInput.setAttribute('type', 'text');
  legendInput.setAttribute('name', legendInputId);
  legendInput.setAttribute('placeholder', 'Вопрос');
  legendInput.setAttribute('rows', '1');
  legendInput.setAttribute('maxlength', '180');
  legendInput.innerHTML = 'Вопрос';
  formGroupActive.append(legendInput);

  var questDelete = document.createElement('a');
  questDelete.classList.add('quest-delete');
  questDelete.setAttribute('type', 'button');
  questDelete.setAttribute('title', 'Delete');
  formGroupActive.append(questDelete);

  var questDeleteIcon = document.createElement('i');
  questDeleteIcon.classList.add('fas');
  questDeleteIcon.classList.add('fa-trash-alt');
  questDelete.append(questDeleteIcon);

  var constrDisabledAnswer = document.createElement('div');
  constrDisabledAnswer.classList.add('text_quest');
  constrDisabledAnswer.classList.add('question');
  formGroupActive.append(constrDisabledAnswer);

  var constrDisabledInput = document.createElement('input');
  constrDisabledInput.setAttribute('type', 'text');
  constrDisabledInput.setAttribute('placeholder', 'Введите ответ');
  constrDisabledInput.disabled = true;
  constrDisabledInput.setAttribute('style', 'width: 90%;');
  constrDisabledAnswer.append(constrDisabledInput);

  var rightLabel = document.createElement('span');
  rightLabel.setAttribute('style', 'margin-left: 20px !important;');
  rightLabel.innerHTML = 'Right answers:';
  formGroupActive.append(rightLabel);

  var constrNewVariant = document.createElement('div');
  constrNewVariant.classList.add('text_quest');
  constrNewVariant.classList.add('question_const');
  constrNewVariant.classList.add('tt');
  formGroupActive.append(constrNewVariant);

  var variantInput = document.createElement('input');
  variantInput.id = labelInputId;
  variantInput.dataset.id = '1';
  variantInput.classList.add('variant-text');
  variantInput.classList.add('t');
  variantInput.setAttribute('placeholder', 'Вариант');
  variantInput.setAttribute('type', 'text');
  variantInput.setAttribute('name', labelInputId);
  variantInput.value = 'Вариант';
  constrNewVariant.append(variantInput);

  var var_del = document.createElement('a');
  var_del.classList.add('variant-delete');
  var_del.classList.add('td');
  var_del.setAttribute('type', 'button');
  var_del.setAttribute('title', 'Delete answer');
  constrNewVariant.append(var_del);

  var var_del_ico = document.createElement('i');
  var_del_ico.classList.add('fas');
  var_del_ico.classList.add('fa-trash-alt');
  var_del.append(var_del_ico);

  var separat = document.createElement('div');
  separat.classList.add('separat');
  separat.setAttribute('style', 'margin-top: 10px !important;');
  formGroupActive.append(separat);

  var hr = document.createElement('hr');
  formGroupActive.append(hr);

  var pointsAmount = document.createElement('div');
  pointsAmount.classList.add('points-amount');
  formGroupActive.append(pointsAmount);

  var labelForPoints = document.createElement('label');
  labelForPoints.setAttribute('for', pointsId);
  labelForPoints.innerHTML = 'Points:';
  pointsAmount.append(labelForPoints);

  var pointsInput = document.createElement('input');
  pointsInput.setAttribute('type', 'text');
  pointsInput.setAttribute('name', pointsId);
  pointsInput.id = pointsId;
  pointsInput.setAttribute('maxlength', '2');
  pointsInput.setAttribute('pattern', '^([1-9]|[1-9][0-9]|100)$');
  pointsInput.setAttribute('title', 'Number from 1 till 100');
  pointsAmount.append(pointsInput);

  // after adding new question
  counter.push(2);
  $(formGroup).hide();
  textareaAutosize();
});


//  resetting id
$('body').on('click', '#confirm', function () {

  var legend1 = document.querySelectorAll('.quest-text-legend');
  for(var r = 0; r < legend1.length; r++){
    var text = ''
    text = text.concat('quest', (r + 1), '_text');
    $(legend1[r]).attr('id', text);
    $(legend1[r]).attr('data-id', (r + 1));
  }

  var forms1 = document.querySelectorAll('.form-group:not(.active)');
  for(var g = 0; g < forms1.length; g++){
    var elems1 = forms1[g].querySelectorAll('.variant-text-label');
    for (var i = 0; i < elems1.length; i++) {
      var text = '';
      text = text.concat('q', (g + 1), '_answer', (i + 1), '_label');
      $(elems1[i]).attr('id', text);
      $(elems1[i]).attr('data-id', (i + 1));
    }
  }

  var legend2 = document.querySelectorAll('.quest-text');
  for(var n = 0; n < legend2.length; n++){
    var text = ''
    text = text.concat('quest', (n + 1));
    $(legend2[n]).attr('id', text);
    $(legend2[n]).attr('data-id', (n + 1));
    $(legend2[n]).attr('name', text);
  }

  var forms2 = document.querySelectorAll('.form-group.active');
  for(var q = 0; q < forms2.length; q++){
    var elems2 = forms2[q].querySelectorAll('.variant-text');
    for (var j = 0; j < elems2.length; j++) {
      var text = '';
      text = text.concat('q', (q + 1), '_answer', (j + 1));
      $(elems2[j]).attr('id', text);
      $(elems2[j]).attr('data-id', (j + 1));
      $(elems2[j]).attr('name', text);
    }
  }
});