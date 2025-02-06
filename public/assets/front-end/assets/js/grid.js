document.querySelectorAll(".grid-option li").forEach(function (element) {
    element.addEventListener("click", function () {
        this.classList.add("active");
        var siblings = Array.from(this.parentNode.children).filter(function (child) {
            return child !== this;
        }, this);
        siblings.forEach(function (sibling) {
            sibling.classList.remove("active");
        });
    });
});

document.querySelector(".grid-option .grid-btn").addEventListener("click", function () {
    document.querySelector(".product-list-section").classList.remove("list-style");
});

document.querySelector(".grid-option .list-btn").addEventListener("click", function () {
    document.querySelector(".product-list-section").classList.add("list-style");
});

document.querySelector('.three-grid').addEventListener('click', function (e) {
    var productSection = document.querySelector(".product-list-section");
    productSection.classList.remove("row-cols-xxl-5", "row-cols-xxl-4", "row-cols-xl-3",
        "row-cols-lg-2", "row-cols-md-3", "row-cols-2", "list-style", "list-detail");
    productSection.classList.add("row-cols-xl-3", "row-cols-lg-2", "row-cols-md-3", "row-cols-2");
});

document.querySelector('.grid-btn').addEventListener('click', function (e) {
    var productSection = document.querySelector(".product-list-section");
    productSection.classList.remove("row-cols-xxl-5", "row-cols-xxl-4", "row-cols-xl-3",
        "row-cols-lg-2", "row-cols-md-3", "row-cols-2", "list-style", "list-detail");
    productSection.classList.add("row-cols-xxl-4", "row-cols-xl-3", "row-cols-lg-2", "row-cols-md-3",
        "row-cols-2");
});

document.querySelector('.list-btn').addEventListener('click', function (e) {
    var productSection = document.querySelector(".product-list-section");
    productSection.classList.remove("row-cols-xxl-5", "row-cols-xxl-4", "row-cols-xl-3",
        "row-cols-lg-2", "row-cols-md-3", "row-cols-2");
    productSection.classList.add("row-cols-12");
});