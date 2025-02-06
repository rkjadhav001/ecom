// user sidebar //

function openNav() {
  var direction = document.dir || document.documentElement.dir; // Get the direction of the document
  var filter = document.getElementById("mySidenav");
  var overlay = document.querySelector(".overlay");

  if (direction === "rtl") {
    // If direction is right-to-left
    filter.style.left = "0";
  } else {
    // If direction is left-to-right
    filter.style.right = "0";
  }

  overlay.style.display = "block";
}

function closeNav() {
  var direction = document.dir || document.documentElement.dir; // Get the direction of the document
  var filter = document.getElementById("mySidenav");
  var overlay = document.querySelector(".overlay");

  if (direction === "rtl") {
    // If direction is right-to-left
    filter.style.left = "-350px";
  } else {
    // If direction is left-to-right
    filter.style.right = "-350px";
  }

  overlay.style.display = "none";
}

// user sidebar end //

// left sidebar start //
function openNavBar() {
  var direction = document.dir || document.documentElement.dir; // Get the direction of the document
  var filter = document.getElementById("myFilter");
  var overlay = document.querySelector(".overlay");

  if (direction === "rtl") {
    // If direction is right-to-left
    filter.style.right = "0";
  } else {
    // If direction is left-to-right
    filter.style.left = "0";
  }

  overlay.style.display = "block";
}

function closeNavBar() {
  var direction = document.dir || document.documentElement.dir; // Get the direction of the document
  var filter = document.getElementById("myFilter");
  var overlay = document.querySelector(".overlay");

  if (direction === "rtl") {
    // If direction is right-to-left
    filter.style.right = "-350px";
  } else {
    // If direction is left-to-right
    filter.style.left = "-350px";
  }

  overlay.style.display = "none";
}
// left sidebar end //

// right sidebar  start//
function openNavR() {
  var direction = document.dir || document.documentElement.dir; // Get the direction of the document
  var filter = document.getElementById("myFilterR");
  var overlay = document.querySelector(".overlay");

  if (direction === "rtl") {
    // If direction is right-to-left
    filter.style.left = "0";
  } else {
    // If direction is left-to-right
    filter.style.right = "0";
  }

  overlay.style.display = "block";
}

function closeNavR() {
  var direction = document.dir || document.documentElement.dir; // Get the direction of the document
  var filter = document.getElementById("myFilterR");
  var overlay = document.querySelector(".overlay");

  if (direction === "rtl") {
    // If direction is right-to-left
    filter.style.left = "-350px";
  } else {
    // If direction is left-to-right
    filter.style.right = "-350px";
  }

  overlay.style.display = "none";
}
// right sidebar  end//

// top filter start //
const titles = document.querySelectorAll(".onclick-title h6");

if (titles.length > 0) {
  titles.forEach((title) => {
    title.addEventListener("click", () => {
      const parent = title.closest(".onclick-title");

      if (parent) {
        // Remove 'show' class from all .onclick-title elements
        document.querySelectorAll(".onclick-title.show").forEach((item) => {
          if (item !== parent) {
            item.classList.remove("show");
          }
        });

        // Toggle 'show' class for the clicked element
        parent.classList.toggle("show");
      }
    });
  });
}

function openNavTop() {
  var direction = document.dir || document.documentElement.dir; // Get the direction of the document
  var filter = document.getElementById("FilterTop");
  var overlay = document.querySelector(".overlay");

  if (direction === "rtl") {
    // If direction is right-to-left
    filter.style.right = "0";
  } else {
    // If direction is left-to-right
    filter.style.left = "0";
  }

  overlay.style.display = "block";
}

function closeNavTop() {
  var direction = document.dir || document.documentElement.dir; // Get the direction of the document
  var filter = document.getElementById("FilterTop");
  var overlay = document.querySelector(".overlay");

  if (direction === "rtl") {
    // If direction is right-to-left
    filter.style.right = "-350px";
  } else {
    // If direction is left-to-right
    filter.style.left = "-350px";
  }

  overlay.style.display = "none";
}

// top filter end //

// size chart //

function toggleContent() {
  var content = document.querySelector(".details-show");
  var button = document.querySelector(".toggle-button");

  if (content.classList.contains("show-content")) {
    content.classList.remove("show-content");
    button.innerText = "Show more";
  } else {
    content.classList.add("show-content");
    button.innerText = "Show less";
  }
}
