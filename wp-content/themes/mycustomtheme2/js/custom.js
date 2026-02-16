
  
    document.addEventListener('DOMContentLoaded', function() {
      const container = document.getElementById('mfp-repeater-container');
      const addButton = document.getElementById('add-row');

      // Add new row
      addButton.addEventListener('click', function() {
        const indexIdx = Date.now(); 
        console.log(indexIdx);
        const newRow = document.createElement('div');
        newRow.className = 'repeater-row';
        newRow.style.cssText = 'margin-bottom: 10px; display: flex; gap: 10px;';
        newRow.innerHTML = `
                    <input type="date" name="movie_repeater_data[${indexIdx}][movie_date]" placeholder="Enter movie date" />
                    <input type="number" name="movie_repeater_data[${indexIdx}][movie_price]" placeholder="Enter price" />
                    <button type="button" class="remove-row button-link-delete">Remove</button>
                `;
        container.appendChild(newRow);
      });

      // Remove row (Event Delegation)
      container.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
          e.target.closest('.repeater-row').remove();
        }
      });
    });
  