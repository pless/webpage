document.addEventListener("DOMContentLoaded", function() {
  const displayText = document.getElementById("displayText");
  const table = document.getElementById("myTable");

  table.addEventListener("mouseover", async function(event) {
    const target = event.target;
    if (target.tagName === "TD") {
      const cellID = target.innerText.replace(' ', '').toLowerCase(); // Transform "Cell 1" to "cell1"
      try {
        const response = await fetch(`${cellID}`);
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
});

