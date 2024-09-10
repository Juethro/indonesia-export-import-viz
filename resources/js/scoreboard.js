document.addEventListener('DOMContentLoaded', function() {
    // Initialize scoreboards
    updateScoreboard('Value');
    updateScoreboard('Volume');

    // Set up event listeners for year navigation
    document.getElementById('prevYearValue').addEventListener('click', () => changeYear('Value', -1));
    document.getElementById('nextYearValue').addEventListener('click', () => changeYear('Value', 1));
    document.getElementById('prevYearVolume').addEventListener('click', () => changeYear('Volume', -1));
    document.getElementById('nextYearVolume').addEventListener('click', () => changeYear('Volume', 1));

    // Add event listener for scoreboard type selection change
    document.getElementById('scoreboardType').addEventListener('change', function() {
        updateScoreboard('Value');
        updateScoreboard('Volume');
    });
});

function changeYear(type, delta) {
    const yearElement = document.getElementById(`currentYear${type}`);
    let year = parseInt(yearElement.textContent) + delta;
    
    // Ensure year is within valid range (2019 to 2023)
    year = Math.max(2019, Math.min(2023, year));
    
    yearElement.textContent = year;
    updateScoreboard(type);
}

function updateScoreboard(type) {
    const year = document.getElementById(`currentYear${type}`).textContent;
    const tipe = document.getElementById("scoreboardType").value; // 'impor' or 'ekspor'

    console.log(`Updating scoreboard: Year=${year}, Type=${type}, Tipe=${tipe}`);

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
        console.log(`Received data:`, data);
        const totalElement = document.getElementById(`total${type}`);
        if (type === 'Value') {
            totalElement.textContent = `$${data.total.toLocaleString()}`;
        } else {
            totalElement.textContent = data.total.toLocaleString();
        }
    })
    .catch(error => console.error("Error:", error));
}

