// table remove js
document.querySelectorAll(".deleteButton").forEach((button) => {
  button.addEventListener("click", function () {
    var row = this.closest("tr");
    if (row) {
      row.parentNode.removeChild(row);
      updateCartCount();
    }
  });
});

function updateCartCount() {
  var rowCount = document.querySelectorAll("#cart-table tbody tr").length;
  var cartTitle = document.getElementById("cartTitle");
  if (cartTitle) {
    cartTitle.textContent = "(" + rowCount + ")";
  }
}
