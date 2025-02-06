document.addEventListener('DOMContentLoaded', function () {
    ImgUpload();
});

function ImgUpload() {
    var imgArray = [];

    document.querySelectorAll('.upload__inputfile').forEach(function (input) {
        input.addEventListener('change', function (e) {
            var imgWrap = this.closest('.upload__box').querySelector('.upload__img-wrap');
            var maxLength = this.dataset.max_length;
            var files = e.target.files;

            Array.from(files).forEach(function (f) {
                if (!f.type.match('image.*') || imgArray.length > maxLength) return;

                var len = imgArray.filter(Boolean).length;
                if (len > maxLength) return;

                imgArray.push(f);

                var reader = new FileReader();
                reader.onload = function (e) {
                    var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + document.querySelectorAll(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                    imgWrap.insertAdjacentHTML('beforeend', html);
                };
                reader.readAsDataURL(f);
            });
        });
    });

    document.body.addEventListener('click', function (e) {
        if (e.target.classList.contains('upload__img-close')) {
            var file = e.target.parentNode.dataset.file;
            var index = imgArray.findIndex(function (img) {
                return img.name === file;
            });
            if (index !== -1) {
                imgArray.splice(index, 1);
            }
            e.target.parentNode.parentNode.remove();
        }
    });
}