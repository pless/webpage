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

  // Changed from mouseover to click
  table.addEventListener("click", async function(event) {
    const target = event.target;
    if (target.tagName === "TD") {
      const fileName = target.getAttribute("data-filename");
      try {
        const response = await fetch(`${fileName}`);
        if (response.ok) {
          let text = await response.text();
          text = text.replace(/\n/g, '<br>'); // Replace line feeds with <br>
          displayText.innerHTML = text;
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
