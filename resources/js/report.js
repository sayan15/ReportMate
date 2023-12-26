

$(document).ready(function () {
    var crimeTypes = {}; // Object to hold the count of each crime type
    var crimeCountsByDay = {};
    Object.entries(incidents).forEach(([key, incident]) => {
        let type = incident.crime_type || 'Unknown'; // Default to 'Unknown' if not set
        if (!crimeTypes[type]) {
            crimeTypes[type] = 0;
        }
        crimeTypes[type]++;

        // per daya how many crimes
        var date = new Date(incident.happenedAt).toDateString(); // Convert to a simple date string

        if (!crimeCountsByDay[date]) {
            crimeCountsByDay[date] = 0;
        }
        crimeCountsByDay[date]++;
    });
    

    //const crimeTypeCounts = JSON.parse(crimeTypes);

    // Prepare the labels and data for the chart
    const chartLabels = Object.keys(crimeTypes);
    const chartData = Object.values(crimeTypes);
    loadPie(chartLabels, chartData)

    //load graph
    const graphLabels = Object.keys(crimeCountsByDay);
    const graphData = Object.values(crimeCountsByDay);
    createGraph(graphLabels, graphData )
})

//create graph
function createGraph(labels,data){
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line', // or 'line', 'pie', etc.
        data: {
            labels: labels,
            datasets: [{
                label: 'Crimes per Day',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

}

//pie chart
function loadPie(crimes, counts) {

    const ctx = document.getElementById("piechart");

    const chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: crimes,
            datasets: [{
                label: 'Number of Incidents',
                data: counts,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

}