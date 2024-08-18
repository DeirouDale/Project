<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php include '../Employee/constants/style.php'; ?>
    <style>
        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #f9f9f9; /* Light background for better readability */
        }

        table th, table td {
            border: 1px solid #ddd; /* Light grey border */
            padding: 12px 15px; /* Increased padding for better readability */
            text-align: left;
        }

        table th {
            background: #0d3c5c; /* Dark blue background */
            color: white;
            font-weight: bold; /* Emphasize headers */
            text-align: center; /* Center-align headers */
        }

        table td {
            background: #ffffff; /* White background for table cells */
            color: #333; /* Darker text for contrast */
        }

        table tr:nth-child(even) td {
            background: #f1f1f1; /* Light grey background for even rows */
        }

        table tr:hover td {
            background: #e0e0e0; /* Light grey background on hover */
        }

        table th, table td {
            border-radius: 4px; /* Rounded corners for cells */
        }

        /* Chart Container Styles */
        .chart-container {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            flex: 1; /* Make charts flexibly fill the row */
            margin-right: 20px; /* Add space between graphs */
        }

        .chart-container:last-child {
            margin-right: 0; /* Remove right margin from the last chart container */
        }

        h2 {
            font-weight: bold;
            color: var(--dark-blue);
        }

        .container h2 {
            margin-bottom: 20px;
        }

        /* Status Overview Styles */
        .status-overview .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border-radius: 8px;
        }

        /* Flexbox for Graphs */
        .graph-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        /* Ensure responsive behavior */
        @media (max-width: 768px) {
            .graph-row {
                flex-direction: column;
            }

            .chart-container {
                margin-right: 0; /* Remove right margin on smaller screens */
                margin-bottom: 20px; /* Add bottom margin for vertical spacing on smaller screens */
            }
        }

        /* Container Styles for Table */
        .table-container {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .date-selector {
            margin-bottom: 20px;
        }
    </style>
    <title>Employee Dashboard</title>
</head>
<body>

<!-- SIDEBAR -->
<?php include("../Employee/constants/side_bar.php"); ?>
<!-- SIDEBAR -->

<!-- CONTENT -->
<section id="content">
    <?php include("../Employee/constants/nav.php"); ?> 

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1 id="table-title">Employee Dashboard</h1>
                <hr>
            </div>
        </div>
        <!-- Announcements Section with Date Selector -->
        <div class="container mt-4">
            <h2>Announcements</h2>
            <div class="date-selector">
                <label for="dateFilter">Select Date:</label>
                <input type="date" id="dateFilter" class="form-control">
            </div>
            <div class="table-container">
                <table id="announcementsTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Announcement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example rows (Replace with PHP-generated rows) -->
                        <tr>
                            <th scope="row">1</th>
                            <td>08/15/2024</td>
                            <td>Company picnic on August 30th!</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>08/10/2024</td>
                            <td>New HR policies will be in effect starting September 1st.</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>08/05/2024</td>
                            <td>All team meetings have been rescheduled to next week.</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Task Overview -->
        <div class="container mt-4 status-overview">
            <h2>Task Overview</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Tasks</h5>
                            <p class="card-text">50</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Accomplished Tasks</h5>
                            <p class="card-text">30</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Pending Tasks</h5>
                            <p class="card-text">20</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Task Accomplishment Chart -->
        <div class="container mt-4">
            <div class="graph-row">
                <div class="chart-container">
                    <h2>Task Accomplishment Rating</h2>
                    <canvas id="taskChart"></canvas>
                </div>
            </div>
        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->
<script src="../script.js"></script>
<script src="../Admin/scripts/charts.js"></script>
<script>
    // Example code to initialize the task accomplishment chart
    var ctx = document.getElementById('taskChart').getContext('2d');
    var taskChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Completed', 'In Progress', 'Pending'],
            datasets: [{
                label: 'Task Accomplishment Rating',
                data: [30, 10, 10], // Example data
                backgroundColor: ['#4caf50', '#ff9800', '#f44336']
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

    // JavaScript for filtering table rows by selected date
    document.getElementById('dateFilter').addEventListener('change', function() {
        var selectedDate = this.value;
        var table = document.getElementById('announcementsTable');
        var rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        for (var i = 0; i < rows.length; i++) {
            var dateCell = rows[i].getElementsByTagName('td')[0].textContent;
            rows[i].style.display = (selectedDate === '' || dateCell === selectedDate) ? '' : 'none';
        }
    });
</script>
</body>
</html>
