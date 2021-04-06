function previewImage(obj){
  var fileReader = new FileReader();
  fileReader.onload = (function() {
    document.getElementById('img').src = fileReader.result;
    document.getElementById('img').style.width = '200px';
    document.getElementById('img').style.height = '100px';
  });
  fileReader.readAsDataURL(obj.files[0]);
}