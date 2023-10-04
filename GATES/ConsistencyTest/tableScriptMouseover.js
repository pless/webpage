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

  // Your previous mouse-over code here, adjusted to work on the newly loaded table
  const displayText = document.getElementById("displayText");
  const table = document.getElementById("myTable");

  table.addEventListener("mouseover", async function(event) {
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

  table.addEventListener("mouseout", function(event) {
    const target = event.target;
    if (target.tagName === "TD") {
      displayText.innerHTML = "Mouse-over a cell to see the text change.";
    }
  });
}

// Load the table when the document is ready
document.addEventListener("DOMContentLoaded", loadTable);
