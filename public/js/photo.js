$(window).load(function(){
$(function() {
// Span
var span = document.getElementsByClassName('upload-path');
// Button
var uploader = document.getElementsByName('file-up');
// On change
for( item in uploader ) {
  // Detect changes
  uploader[item].onchange = function() {
    // Echo filename in span
    span[0].innerHTML = this.files[0].name;
  }
}


  $('#photo-file').change(function(e) {
     addImage(e);
    });

function addImage(e){
  var file = e.target.files[0],
  imageType = /image.*/;

  if (!file.type.match(imageType))
    return;

  var reader = new FileReader();
  reader.onload = fileOnload;
  reader.readAsDataURL(file);
}

function fileOnload(e) {
  var result=e.target.result;
  $('#img-photo').attr("src",result);
  }
});
});


$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
