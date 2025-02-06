const selectList = document.querySelectorAll(".select-menu");
selectList.forEach(function (el) {
    el.addEventListener("click", function (e) {
        e.preventDefault();
        const clicked = e.target.closest(".select-item");
        if (!clicked) return;
        const text = clicked.textContent;
        const btnChangeText =
            this.closest(".dropdown").querySelector(".select-dropdown");
        btnChangeText.textContent = text;
    });
});