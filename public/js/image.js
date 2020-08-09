$('#recipeImage').on('change', function (e) {
  var reader = new FileReader();
  reader.onload = function (e) {
      $("#recipeImagePreview").attr('src', e.target.result);
  }
  reader.readAsDataURL(e.target.files[0]);
});

$('#userImage').on('change', function (e) {
  var reader = new FileReader();
  reader.onload = function (e) {
      $("#userImagePreview").attr('src', e.target.result);
  }
  reader.readAsDataURL(e.target.files[0]);
});

$('#userEditImage').on('change', function (e) {
  var reader = new FileReader();
  reader.onload = function (e) {
      $("#userEditImagePreview").attr('src', e.target.result);
  }
  reader.readAsDataURL(e.target.files[0]);
});