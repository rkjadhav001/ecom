// hide sidebar start //

// Select the element and the button
const myElement = document.getElementById("filter_class");
const toggleButton = document.getElementById("hide_bar");

// Add event listener to the button
toggleButton.addEventListener("click", () => {
  // Toggle the class on the element
  myElement.classList.toggle("hide-filter");

  // Update the button text based on the class presence
  if (myElement.classList.contains("hide-filter")) {
    toggleButton.textContent = "Show Filter";
  } else {
    toggleButton.textContent = "Hide Filter";
  }
});
