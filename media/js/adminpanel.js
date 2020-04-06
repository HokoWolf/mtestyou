$(document).ready(function() {
  var tables = document.querySelectorAll("table");
  $(tables[0]).addClass("visible");
});

$("#sidebar-btn").click(function() {
  $("#sidebarMenu").toggleClass("visible");
  $("#container").toggleClass("visible");
  $("table").toggleClass("flex-table");
});

var tables_bt = document.querySelectorAll(".table_bt");
for (let i = 0; i < tables_bt.length; i++) {
  tables_bt[i].onclick = function() {
    var tables = document.querySelectorAll("table");
    for (let j = 0; j < tables.length; j++) $(tables[j]).removeClass("visible");

    var words = tables_bt[i].id.split("_");
    var table_id = "#";
    table_id = table_id.concat(words[0]);
    $(table_id).toggleClass("visible");
  };
}

jQuery(function($){
	$(document).mouseup(function (e){
    var div = $('#changeable');
    if (!div.is(e.target) && div.has(e.target).length === 0)
    {
      $(div).removeAttr('id');
      $(div).attr("contenteditable", "false");
      $(div).css("background-color", "#ccc");
    }
	});
});

$("body").on("dblclick", "td:not(.options)", function () {
  $(this).attr("id", "changeable")
  $(this).attr("contenteditable", "true");
  $(this).css("background-color", "white");
});

$('#insert').click(function(){
  var td_count = $("table.visible>tbody>tr>th").length - 2;
  var new_tr = document.createElement("tr");
  $("table.visible>tbody").append(new_tr);

  for (let i = 0; i < td_count; i++) {
    var new_td = document.createElement("td");
    new_td.contentEditable = false;
    new_td.spellcheck = false;
    new_tr.append(new_td);
  }
  var option1 = document.createElement("td");
  option1.classList.add('options');
  option1.classList.add('delete');
  new_tr.append(option1);

  var icon1 = document.createElement("i");
  icon1.classList.add('fas');
  icon1.classList.add('fa-trash-alt');
  option1.append(icon1)

  var option2 = document.createElement("td");
  option2.classList.add('options');
  option2.classList.add('update');
  new_tr.append(option2);

  var icon2 = document.createElement("i");
  icon2.classList.add('fas');
  icon2.classList.add('fa-edit');
  option2.append(icon2)

  $(".update.changing").removeClass('changing');
  $("td").css("background-color", "#ccc");
  $("td").css("contenteditable", "false");
  $(".fa-check-square").addClass("fa-edit");
  $(".fa-edit").removeClass("fa-check-square");
  option2.classList.add('changing');
  $(option2).children().remove();
  var update_contant = document.createElement("i");
  update_contant.classList.add("fas");
  update_contant.classList.add("fa-check-square");
  option2.append(update_contant);

  var td = $(option2.parentNode).children("td:not(.options)");
  for (let i = 0; i < td.length; i++) {
    td[i].contentEditable = true;
    td[i].style.backgroundColor = "white";
  }
});

$("body").on("click", ".delete", function(){
  $(this.parentNode).remove();
});

$("body").on("click", ".update:not(.changing)", function(){
  $(".update.changing").removeClass('changing');
  $("td").css("background-color", "#ccc");
  $("td").css("contenteditable", "false");
  $(".fa-check-square").addClass("fa-edit");
  $(".fa-edit").removeClass("fa-check-square");
  this.classList.add("changing");
  $(this).children().remove();
  var update_contant = document.createElement("i");
  update_contant.classList.add("fas");
  update_contant.classList.add("fa-check-square");
  this.append(update_contant);

  var td = $(this.parentNode).children("td:not(.options)");
  for (let i = 0; i < td.length; i++) {
    td[i].contentEditable = true;
    td[i].style.backgroundColor = "white";
  }
});

$("body").on("click", ".update.changing", function(){
  $(this).removeClass("changing");
  $(this).children().remove();
  var icon2 = document.createElement("i");
  icon2.classList.add('fas');
  icon2.classList.add('fa-edit');
  this.append(icon2)

  var td = $(this.parentNode).children("td:not(.options)");
  for (let i = 0; i < td.length; i++) {
    td[i].contentEditable = false;
    td[i].style.backgroundColor = "#ccc";
  }
});