$(document).ready(function () {
  // Editor
  ClassicEditor.create(document.querySelector("#ckeditor_editor")).catch(
    (error) => {
      console.error(error);
    }
  );

  //Other
  $("#selectAllBoxes").click(function (event) {
    if (this.checked) {
      $(".custom_checkBoxes").each(function () {
        this.checked = true;
      });
    } else {
      $(".custom_checkBoxes").each(function () {
        this.checked = false;
      });
    }
  });

  var div_box = "<div id='load-screen'><div id='loading'></div></div>";
  $("body").prepend(div_box);

  $("#load-screen")
    .delay(400)
    .fadeOut(500, function () {
      $(this).remove();
    });
});

function loadUserOnline() {
  $.get("functions/session_fn.php?onlineusers=result", function (data) {
    $(".usersonline").text(data);
  });
}

setInterval(function () {
  loadUserOnline();
}, 1000);
