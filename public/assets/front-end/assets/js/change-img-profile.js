 function readURL(input) {
     if (input.files && input.files[0]) {
         var reader = new FileReader();
         reader.onload = function (e) {
             document.getElementById('imagePreview').style.backgroundImage = 'url(' + e.target.result + ')';
             document.getElementById('imagePreview').style.display = 'none';
             document.getElementById('imagePreview').style.display = 'block';
         }
         reader.readAsDataURL(input.files[0]);
     }
 }

 document.getElementById('imageUpload').addEventListener('change', function () {
     readURL(this);
 });