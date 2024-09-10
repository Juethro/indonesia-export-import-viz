document.addEventListener('DOMContentLoaded', function() {
    // Initialize scoreboards for both Value and Volume
    updateScoreboard('Value');
    updateScoreboard('Volume');

    // Set up event listeners for year navigation
    document.getElementById('prevYearValue').addEventListener('click', () => changeYear('Value', -1));
    document.getElementById('nextYearValue').addEventListener('click', () => changeYear('Value', 1));
    document.getElementById('prevYearVolume').addEventListener('click', () => changeYear('Volume', -1));
    document.getElementById('nextYearVolume').addEventListener('click', () => changeYear('Volume', 1));

    // Add event listener for scoreboard type selection change
    document.getElementById('scoreboardType').addEventListener('change', function() {
        // Update both Value and Volume when the type (impor/ekspor) is changed
        updateScoreboard('Value');
        updateScoreboard('Volume');
    });
});

function changeYear(type, delta) {
    const yearElement = document.getElementById(`currentYear${type}`);
    let year = parseInt(yearElement.textContent) + delta;
    
    // Ensure year is within valid range (2019 to 2023)
    if (year < 2019 || year > 2023) {
        return; // Prevent further updates if out of bounds
    }

    yearElement.textContent = year;
    updateScoreboard(type);
}

function updateScoreboard(type) {
    const year = document.getElementById(`currentYear${type}`).textContent;
    const tipe = document.getElementById("scoreboardType").value; // 'impor' or 'ekspor'

    // Reset the scoreboard value before fetching new data
    const totalElement = document.getElementById(`total${type}`);
    totalElement.textContent = "Loading...";

    fetch('/data/scoreboard', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            year: year,
            type: type,
            tipe: tipe,
        }),
    })
    .then(response => response.json())
    .then(data => {
        // Ensure scoreboard updates correctly
        if (type === 'Value') {
            totalElement.textContent = `$${data.total.toLocaleString()}`;
        } else {
            totalElement.textContent = data.total.toLocaleString();
        }
    })
    .catch(error => {
        console.error("Error:", error);
        totalElement.textContent = "Error";  // Display error message in case of failure
    });
}
