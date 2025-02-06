/*====================
 Ratio js
=======================*/
window.addEventListener("load", () => {
  const bgImg = document.querySelectorAll(".bg-img");
  for (i = 0; i < bgImg.length; i++) {
    let bgImgEl = bgImg[i];

    if (bgImgEl.classList.contains("bg-top")) {
      bgImgEl.parentNode.classList.add("b-top");
    } else if (bgImgEl.classList.contains("bg-bottom")) {
      bgImgEl.parentNode.classList.add("b-bottom");
    } else if (bgImgEl.classList.contains("bg-center")) {
      bgImgEl.parentNode.classList.add("b-center");
    } else if (bgImgEl.classList.contains("bg-left")) {
      bgImgEl.parentNode.classList.add("b-left");
    } else if (bgImgEl.classList.contains("bg-right")) {
      bgImgEl.parentNode.classList.add("b-right");
    }

    if (bgImgEl.classList.contains("blur-up")) {
      bgImgEl.parentNode.classList.add("blur-up", "lazyload");
    }

    if (bgImgEl.classList.contains("bg_size_content")) {
      bgImgEl.parentNode.classList.add("b_size_content");
    }

    bgImgEl.parentNode.classList.add("bg-size");
    const bgSrc = bgImgEl.src;
    bgImgEl.style.display = "none";
    bgImgEl.parentNode.setAttribute(
      "style",
      `
      background-image: url(${bgSrc});
      background-size:cover;
      background-position: center;
      background-repeat: no-repeat;
      display: block;
      `
    );
  }
});
// Ratio js end //

// <!-- ========== Start Section ==========
const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);
// <!-- ========== End Section ==========

// top header //
function myFunction() {
  document.getElementById("myDIV").style.display = "none";
}
// top header //

//  footer start //
document.querySelectorAll(".footer-section h5").forEach(function (element) {
  element.addEventListener("click", function () {
    var parentNav = this.closest(".folder-menu");
    if (parentNav) {
      parentNav.classList.toggle("open");
      var offsetTop = this.getBoundingClientRect().top + window.scrollY - 170;
      window.scrollTo({
        top: offsetTop,
        behavior: "smooth",
      });
    }
  });
});
// footer end //

// active //

// Get all elements matching the selector
var elements = document.querySelectorAll(".size  li");
// Attach a click event listener to each element
elements.forEach(function (element) {
  element.addEventListener("click", function () {
    // Remove 'active' class from all elements
    elements.forEach(function (el) {
      el.classList.remove("active");
    });

    // Add 'active' class to the clicked element
    this.classList.add("active");
  });
});

//  counter js //
function increaseCount(a, b) {
  var input = b.previousElementSibling;
  var value = parseInt(input.value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  input.value = value;
}

function decreaseCount(a, b) {
  var input = b.nextElementSibling;
  var value = parseInt(input.value, 10);
  if (value > 1) {
    value = isNaN(value) ? 0 : value;
    value--;
    input.value = value;
  }
}
//  counter js //

/*=====================
    wishlist added start
==========================*/
const divs = document.querySelectorAll(".like-btn");
divs.forEach((el) =>
  el.addEventListener("click", (event) => {
    event.target.parentNode.classList.toggle("animate");
    event.target.parentNode.classList.toggle("active");
    event.target.parentNode.classList.toggle("inactive");
  })
);

// wishlish end

// otp input js //

document.querySelectorAll(".autoCompleteForm").forEach((form) => {
  form.querySelectorAll(".digit-input").forEach((input, index, inputs) => {
    input.addEventListener("keyup", function (e) {
      const next = this.nextElementSibling;
      const prev = this.previousElementSibling;
      if (
        (e.keyCode >= 48 && e.keyCode <= 57) ||
        (e.keyCode >= 65 && e.keyCode <= 90) ||
        (e.keyCode >= 96 && e.keyCode <= 105) ||
        e.keyCode === 39
      ) {
        if (next) next.focus();
      } else if (e.keyCode === 8 || e.keyCode === 37) {
        if (prev) prev.focus();
      } else if (!next && form.dataset.autosubmit === "true") {
        form.submit();
      }

      // Check if this is the last input field
      if (index === inputs.length - 1 && this.value !== "") {
        // If yes, and if autosubmit is enabled, submit the form
        if (form.dataset.autosubmit === "true") {
          form.submit();
        }
      }
    });
  });
});

//  otp input js end //

/*================================
 Add To Cart Notification js
  ==================================*/
window.addEventListener("load", () => {
  const setupButton = (buttonSelector, messageSelector) => {
    const buttons = document.querySelectorAll(buttonSelector);
    buttons.forEach((button) => {
      button.addEventListener("click", function () {
        const messageContainer = document.querySelector(messageSelector);
        const progressBar = messageContainer.querySelector(".progress");

        messageContainer.classList.add("show");
        progressBar.style.width = "0%";

        let progress = 0;
        const interval = setInterval(() => {
          if (progress >= 100) {
            clearInterval(interval);
          } else {
            progress++;
            progressBar.style.width = progress + "%";
          }
        }, 40); // 4000ms / 100 steps = 40ms per step

        setTimeout(() => {
          messageContainer.classList.remove("show");
          progressBar.style.width = "0%"; // Reset the progress bar
        }, 4000);
      });
    });
  };

  setupButton(".addtocart-btn", ".addToCart");
  setupButton(".wishlist-btn", ".addToWishlist");
});

/*===================== 
 Tap To Top Js 
==========================*/
window.addEventListener("scroll", function () {
  var tapTopElement = document.querySelector(".tap-top");
  if (window.scrollY > 600) {
    tapTopElement.classList.add("top");
  } else {
    tapTopElement.classList.remove("top");
  }
});

var tapTopElement = document.querySelector(".tap-top");
tapTopElement.addEventListener("click", function () {
  document.documentElement.scrollTop = 0;
  document.body.scrollTop = 0;
  return false;
});
/*===================== 
 compare-btn Js 
==========================*/
// Select all elements with the class 'compare'
const compareButtons = document.querySelectorAll(".ri-loop-right-fill");

// Add event listener to each 'compare' element
compareButtons.forEach((button) => {
  button.addEventListener("click", () => {
    // Select all the div elements with class 'item'
    const items = document.getElementById("compareDiv");

    // Loop through each 'item' div and add the 'highlight' class
    items.classList.add("show");
  });
});
