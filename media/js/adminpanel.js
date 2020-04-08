$(document).ready(function () {
  var tables = document.querySelectorAll("table");
  $(tables[0]).addClass("visible");
});

$("#sidebar-btn").click(function () {
  $("#sidebarMenu").toggleClass("visible");
  $("#container").toggleClass("visible");
  $("table").toggleClass("flex-table");
});

var tables_bt = document.querySelectorAll(".table_bt");
for (let i = 0; i < tables_bt.length; i++) {
  tables_bt[i].onclick = function () {
    var tables = document.querySelectorAll("table");
    for (let j = 0; j < tables.length; j++) $(tables[j]).removeClass("visible");

    var words = tables_bt[i].id.split("_");
    var table_id = "#";
    table_id = table_id.concat(words[0]);
    $(table_id).toggleClass("visible");
  };
}

jQuery(function ($) {
  $(document).mouseup(function (e) {
    var div = $(".changeable");
    var td = document.getElementsByClassName("changeable");

    if (!div.is(e.target) && div.has(e.target).length === 0) {
      if (localStorage.getItem("insert")) {
        var table = td[0].parentNode.id.split("_")[0];
        let data = {};

        for (let i = 0; i < td.length; i++) {
          var td_data = td[i].id.split("_");
          if (td_data.length > 3) {
            td_data[2] = td_data[2].concat("_", td_data[3]);
          }
          data[td_data[2]] = td[i].textContent;
        }

        function succFunc() {
          alert("Вы успешно добавили эту запись!");
        }

        $.ajax({
          url: "admin_handler.php",
          type: "POST",
          data: {
            func: "insert",
            table: table,
            data: JSON.stringify(data),
          },
          dataType: "html",
          success: succFunc(),
        });

        localStorage.removeItem("insert");
      } else if (td.length == 1) {
        var data = td[0].id.split("_");
        var table = data[0];
        var id = data[1];
        if (data.length > 3) {
          data[2] = data[2].concat("_", data[3]);
        }
        var col = data[2];
        var value = td[0].textContent;

        $.ajax({
          url: "admin_handler.php",
          type: "POST",
          data: {
            func: "update",
            table: table,
            id: id,
            col: col,
            value: value,
          },
          dataType: "html",
          error: function () {
            alert("ДАННЫЕ НЕ БЫЛИ ОБНОВЛЕНЫ! :(");
          },
          success: function () {
            alert("Вы успешно изменили эту запись!");
          },
        });
      } else {
        for (let i = 0; i < td.length; i++) {
          var data = td[i].id.split("_");
          var table = data[0];
          var id = data[1];
          if (data.length > 3) {
            data[2] = data[2].concat("_", data[3]);
          }
          var col = data[2];
          var value = td[i].textContent;

          function succFunc() {
            if (count == max) {
              alert("Вы успешно изменили эту запись!");
            }
          }

          $.ajax({
            url: "admin_handler.php",
            type: "POST",
            data: {
              func: "update",
              table: table,
              id: id,
              col: col,
              value: value,
            },
            dataType: "html",
            success: succFunc(),
          });
        }
      }

      $(div).removeClass("changeable");
      $(div).attr("contenteditable", "false");
      $(div).css("background-color", "#ccc");
      var change = document.querySelector(".update.changing");
      if (!change) {
        return;
      } else {
        $(change).removeClass("changing");
        $(change).children().remove();
        var icon2 = document.createElement("i");
        icon2.classList.add("fas");
        icon2.classList.add("fa-edit");
        change.append(icon2);
      }
    }
  });
});

$("body").on("dblclick", "td:not(.options)", function () {
  $("td").removeClass("changeable");
  $("td").css("background-color", "#ccc");
  $("td").css("contenteditable", "false");
  $(this).attr("class", "changeable");
  $(this).attr("contenteditable", "true");
  $(this).css("background-color", "white");
});

$("#insert").click(function () {
  var td_info = document.querySelectorAll("table.visible>tbody>tr");

  var td_count = $("table.visible>tbody>tr>th").length - 2;
  var new_tr = document.createElement("tr");
  var inf = td_info[td_info.length - 1].id.split("_");
  var tr_id = "";
  tr_id = tr_id.concat(inf[0], "_", Number(inf[1]) + 1);
  new_tr.id = tr_id;
  $("table.visible>tbody").append(new_tr);

  td_info = $(td_info[td_info.length - 1]).children("td");

  for (let i = 0; i < td_count; i++) {
    var new_td = document.createElement("td");
    new_td.contentEditable = false;
    new_td.spellcheck = false;
    new_td.classList.add("changeable");
    var info = td_info[i].id.split("_");
    if (info.length > 3) {
      info[2] = info[2].concat("_", info[3]);
    }
    var new_id = "";
    new_id = new_id.concat(info[0], "_", Number(info[1]) + 1, "_", info[2]);
    new_td.id = new_id;
    new_tr.append(new_td);
    localStorage.setItem("insert", true);
  }

  var option1 = document.createElement("td");
  option1.classList.add("options");
  option1.classList.add("delete");
  new_tr.append(option1);

  var icon1 = document.createElement("i");
  icon1.classList.add("fas");
  icon1.classList.add("fa-trash-alt");
  option1.append(icon1);

  var option2 = document.createElement("td");
  option2.classList.add("options");
  option2.classList.add("update");
  new_tr.append(option2);

  var icon2 = document.createElement("i");
  icon2.classList.add("fas");
  icon2.classList.add("fa-edit");
  option2.append(icon2);

  $(".update.changing").removeClass("changing");
  $("td").css("background-color", "#ccc");
  $("td").css("contenteditable", "false");
  $("td").removeClass("changeable");
  $(".fa-check-square").addClass("fa-edit");
  $(".fa-edit").removeClass("fa-check-square");
  option2.classList.add("changing");
  $(option2).children().remove();
  var update_contant = document.createElement("i");
  update_contant.classList.add("fas");
  update_contant.classList.add("fa-check-square");
  option2.append(update_contant);

  var td = $(option2.parentNode).children("td:not(.options)");
  for (let i = 1; i < td.length; i++) {
    td[i].contentEditable = true;
    td[i].style.backgroundColor = "white";
    td[i].classList.add("changeable");
  }
});

$("body").on("click", ".delete", function () {
  var data = this.parentNode.id.split("_");
  var table = data[0];
  var id = data[1];

  $.ajax({
    url: "admin_handler.php",
    type: "POST",
    data: { func: "delete", table: table, id: id },
    dataType: "html",
    beforeSend: function () {
      if (!confirm("Вы точно хотите удалить эту запись?")) exit();
    },
    error: function () {
      alert("ЭТА ЗАПИСЬ НЕ БЫЛА УДАЛЕНА! :(");
    },
    success: function () {
      alert("Вы успешно удалили эту запись!");
    },
  });

  $(this.parentNode).remove();
});

$("body").on("click", ".update:not(.changing)", function () {
  $(".update.changing").removeClass("changing");
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
  for (let i = 1; i < td.length; i++) {
    td[i].contentEditable = true;
    td[i].style.backgroundColor = "white";
    td[i].classList.add("changeable");
  }
});

$("body").on("click", ".update.changing", function () {
  $(this).removeClass("changing");
  $(this).children().remove();
  var icon2 = document.createElement("i");
  icon2.classList.add("fas");
  icon2.classList.add("fa-edit");
  this.append(icon2);

  var td = $(this.parentNode).children("td:not(.options)");
  for (let i = 0; i < td.length; i++) {
    td[i].contentEditable = false;
    td[i].style.backgroundColor = "#ccc";
  }
});
