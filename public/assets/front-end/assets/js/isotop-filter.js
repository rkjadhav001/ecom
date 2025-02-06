document.addEventListener("DOMContentLoaded", function () {
  var buttons = document.querySelectorAll(".btn");

  buttons.forEach(function (button) {
    button.addEventListener("click", function () {
      if (this.id === "all") {
        document.querySelectorAll("#parent > div").forEach(function (div) {
          div.style.display = "block";
          div.style.opacity = 0;
          setTimeout(function () {
            div.style.transition = "opacity 450ms";
            div.style.opacity = 1;
          }, 10);
        });
      } else {
        var elementsToShow = document.querySelectorAll("." + this.id);
        document.querySelectorAll("#parent > div").forEach(function (div) {
          if ([...elementsToShow].includes(div)) {
            div.style.display = "block";
            div.style.opacity = 0;
            setTimeout(function () {
              div.style.transition = "opacity 450ms";
              div.style.opacity = 1;
            }, 10);
          } else {
            div.style.display = "none";
          }
        });
      }

      buttons.forEach(function (btn) {
        btn.classList.remove("active");
      });
      this.classList.add("active");
    });
  });
});
