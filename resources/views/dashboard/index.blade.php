<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Include Chart.js via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .chart-container {
            width: 50%;
            margin: 0 1%;
            padding: 20px;
            box-sizing: border-box;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        canvas {
            max-width: 100%;
            height: auto;
        }

        .charts-wrapper {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;

        }
    </style>
</head>
<body>

<div class="container">
    <h1>Dashboard</h1>

    <div class="charts-wrapper">
        <!-- Pie Chart for Category Distribution -->
        <div class="chart-container">
            <h2>Category Distribution</h2>
            <canvas id="categoryPieChart"></canvas>
        </div>

        <!-- Column Chart for Data Aggregation by Date -->
        <div class="chart-container">
            <h2>Data Aggregation by Date</h2>
            <canvas id="dateColumnChart"></canvas>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Data for Category Pie Chart
        const categoryData = @json($categoryData);
        const categoryLabels = categoryData.map(item => item.category);
        const categoryCounts = categoryData.map(item => item.count);

        // Create Pie Chart for Category Distribution
        new Chart(document.getElementById('categoryPieChart'), {
            type: 'pie',
            data: {
                labels: categoryLabels,
                datasets: [{
                    data: categoryCounts,
                    backgroundColor: ['#ff6384', '#36a2eb', '#ffce56'],
                }]
            }
        });

        // Data for Date Column Chart
        const dateData = @json($dateData);
        const dateLabels = dateData.map(item => item.date);
        const dateCounts = dateData.map(item => item.count);

        // Create Column Chart for Data Aggregation by Date
        new Chart(document.getElementById('dateColumnChart'), {
            type: 'bar',
            data: {
                labels: dateLabels,
                datasets: [{
                    label: 'People Count',
                    data: dateCounts,
                    backgroundColor: '#4bc0c0',
                }]
            }
        });
    });
</script>

</body>
</html>
