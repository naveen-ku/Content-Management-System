$(document).ready(function () {
  // Editor
  ClassicEditor.create(document.querySelector("#ckeditor_editor")).catch(
    (error) => {
      console.error(error);
    }
  );

  //Other
});
