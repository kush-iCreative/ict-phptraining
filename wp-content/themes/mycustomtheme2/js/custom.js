document.addEventListener("DOMContentLoaded", function () {
  const container = document.getElementById("mfp-repeater-container");
  const addButton = document.getElementById("add-row");
  const Form = document.getElementById("post");
  const errorMessage = document.getElementById("error-message");

  Form.addEventListener("submit", function (e) {
    const dates = document.querySelectorAll('input[type="date"]');
    const prices = document.querySelectorAll('input[type="number"]');

    let message = "";
    let hasError = false; 

    dates.forEach(function (dateField, index) {
      let priceField = prices[index]; 
      let dateEmpty = dateField.value.trim() === ""; 
      let priceEmpty = priceField.value.trim() === ""; 
      dateField.style.border ='';
      priceField.style.border = '';

      if (dateEmpty && priceEmpty) {
         message = "Please fill both fields";
         dateField.style.border = '1px solid red';
         priceField.style.border = '1px solid red';
        hasError = true; 
      } else if (dateEmpty) {
        message = "Please fill in the date field";
        dateField.style.border = '1px solid red';
        hasError = true; 
      } else if (priceEmpty) {
        message = "Please fill in the price field";
        priceField.style.border = '1px solid red';
        hasError = true; 
      }
    });

    if (hasError) {
      e.preventDefault();
      errorMessage.innerText = message;
      errorMessage.style.display = "block";
    } else {
      errorMessage.style.display = "none";
    }
  }); 

  function reIndexRows() {
    const rows = container.querySelectorAll(".repeater-row");

    rows.forEach(function (row, index) {
      row.querySelector('input[type="date"]').name =`movie_repeater_data[${index}][movie_date]`;
      row.querySelector('input[type="number"]').name =`movie_repeater_data[${index}][movie_price]`;
    });
    // console.log(rows);
  }

  addButton.addEventListener("click", function () {
    const rowCount = container.querySelectorAll(".repeater-row").length;
    const newRow = document.createElement("div");
    newRow.className = "repeater-row";
    newRow.style.cssText = "margin-bottom:10px; display:flex; gap:10px;";

    newRow.innerHTML = `
    <input type="date" name="movie_repeater_data[${rowCount}][movie_date]" placeholder="Enter movie date" />
     <input type="number" name="movie_repeater_data[${rowCount}][movie_price]"placeholder="Enter movie price" />

    <button type="button" class="remove-row button-link-delete">Remove</button>`;

    container.appendChild(newRow);
  });

  // Remove Row
  container.addEventListener("click", function (e) {
    if (e.target.classList.contains("remove-row")) {
      e.target.closest(".repeater-row").remove();

      reIndexRows();
    }
  });
});
