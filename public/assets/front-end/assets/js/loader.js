/*====================
    loader js
=======================*/
setTimeout(function () {
    var loaders = document.getElementsByClassName('loader-wrapper');
    for (var i = 0; i < loaders.length; i++) {
        loaders[i].style.display = 'none';
    }
    document.body.style.overflow = 'auto';
}, 3500);
document.body.style.overflow = 'hidden';