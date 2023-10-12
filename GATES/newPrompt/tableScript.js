// Function to load table
async function loadTable() {
  const tableContainer = document.getElementById('tableContainer');

  try {
    const response = await fetch('table.html');
    const tableHTML = await response.text();
    tableContainer.innerHTML = tableHTML;
  } catch (error) {
    tableContainer.innerHTML = 'Failed to load table.';
  }

  const displayText = document.getElementById("displayText");
  const table = document.getElementById("myTable");

  let lastClickedCell = null;  // To keep track of the last clicked cell

  // Changed from mouseover to click
  table.addEventListener("click", async function(event) {
    const target = event.target;
    // Remove the highlight from the last clicked cell, if any
    if (lastClickedCell) {
      lastClickedCell.classList.remove("highlight");
    }
  
    // Highlight the current clicked cell
    target.classList.add("highlight");
    lastClickedCell = target;
    if (target.tagName === "TD") {
      const fileName = target.getAttribute("data-filename");
      const summaryText = target.innerText; // Get the text content of the clicked cell
      const row = target.parentNode;
      const cellIndex = target.cellIndex;  // Get the index of the clicked cell within its row
      const firstColumnText = row.cells[0].innerText;
      const firstRow = table.rows[0];
      const columnHeader = firstRow.cells[cellIndex].innerText;

      try {
        const response = await fetch(`${fileName}`);
        if (response.ok) {
          let text = await response.text();
          text = text.replace(/\n/g, '<br>'); // Replace line feeds with <br>
            displayText.innerHTML = `<strong>${firstColumnText}<br>Summary of ${columnHeader}:</strong> ${summaryText}<hr>${text}`;
        } else {
          displayText.innerHTML = "Failed to fetch text for this cell.";
        }
      } catch (error) {
        displayText.innerHTML = "An error occurred while fetching text.";
      }
    }
  });

  // Removed mouseout event as it won't be necessary for clicks
}

// Load the table when the document is ready
document.addEventListener("DOMContentLoaded", loadTable);
