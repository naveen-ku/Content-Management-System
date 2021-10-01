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
});
