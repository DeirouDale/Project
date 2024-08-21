<?php
include '../connection.php';

// Pagination variables
$limit = 6; // Number of entries per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Query to fetch total number of announcements
$count_sql = "SELECT COUNT(*) AS total FROM announcements";
$count_result = $conn->query($count_sql);
$total_announcements = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_announcements / $limit);

// Query to fetch announcements for the current page
$sql = "SELECT date_posted, title, description, file_name FROM announcements LIMIT $start, $limit";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/main.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/main.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> 
     <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <?php include '../Employee/constants/style.php'; ?>
    <style>
        #content main .box-info-4 {
            display: flex;
            justify-content: space-between;
            margin-top: 36px;
        }

        #content main .box-info-4 li {
            padding: 24px;
            background: var(--light);
            border-radius: 20px;
            display: flex;
            align-items: center;
            grid-gap: 24px;
            cursor: pointer;
            flex: 1;
            margin: 0 12px;
        }

        #content main .box-info-4 li .bx {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            font-size: 36px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #content main .box-info-4 li:nth-child(1) .bx {
            background: var(--light-blue);
            color: var(--blue);
        }

        #content main .box-info-4 li:nth-child(2) .bx {
            background: var(--light-yellow);
            color: var(--yellow);
        }

        #content main .box-info-4 li:nth-child(3) .bx {
            background: var(--light-orange);
            color: var(--orange);
        }

        #content main .box-info-4 li:nth-child(4) .bx {
            background: var(--dark-grey);
            color: var(--dark);
        }

        #content main .box-info-4 li .text h3 {
            font-size: 24px;
            font-weight: 600;
            color: var(--dark);
        }

        #content main .box-info-4 li .text p {
            font-size: 18px;
            color: #4b090a;
        }

        /* Table container */
        .table-container {
            background: var(--light);
            padding: 24px;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 100%; /* Prevent exceeding container's width */
            box-sizing: border-box; /* Include padding and border in element's total width and height */
            overflow: hidden; /* Prevent content overflow */
            margin-top: 20px;
        }

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

        .table-container h2 {
            font-size: 30px;
            font-weight: bold;
            color: #0d3c5c; /* Dark blue color for the header */
            display: flex;
            align-items: center;
            gap: 8px; /* Space between icon and text */
        }

        .table-container i.fas.fa-bell {
            color: #f39c12; /* Golden color for the bell icon */
            font-size: 32px; /* Size of the bell icon */
        }

        /* Charts container */
/* Responsive charts container */
.chart-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .chart-title {
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

@media (min-width: 768px) {
    .charts-container {
        flex-direction: row;
    }
}

.chart-box {
    height: 400px; /* Increased height for better chart visualization */
}


/* Style for individual charts */
.chart-box {
    background: var(--light);
    padding: 24px;
    border-radius: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    flex: 1; /* Allow charts to grow and shrink */
    min-width: 0; /* Prevent overflow and ensure proper resizing */
    height: 300px; /* Set a fixed height for charts */
}

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .page-link {
            margin: 0 5px;
            padding: 10px 15px;
            background: #0d3c5c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .page-link.active {
            background: #004d80;
        }

        .page-link:hover {
            background: #003a5b;
        }
    </style>

    <title>SDO Batac LRMS</title>
</head>

<body>
    <!-- SIDEBAR -->
    <?php include("../Employee/constants/side_bar.php"); ?>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <?php include("../Employee/constants/nav.php"); ?>

        <!-- MAIN -->
        <main class="flex-1 p-6">
            <div class="container-Dashboard" id="Dashboard">
            <div class="head-title">
            <div class="left">
                <h1>Dashboard<hr>
            </div>

                <!-- Info Cards -->
                <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <li class="flex items-center p-6 bg-white rounded-lg shadow-lg">
                        <i class='bx bxs-group text-blue-600 text-4xl mr-4'></i>
                        <div class="text">
                            <h3 class="text-xl font-semibold text-gray-700">Content Here</h3>
                        </div>
                    </li>
                    <li class="flex items-center p-6 bg-white rounded-lg shadow-lg">
                        <i class='bx bxs-check-square text-yellow-500 text-4xl mr-4'></i>
                        <div class="text">
                            <p class="text-xl font-semibold text-gray-700">Content Here</p>
                        </div>
                    </li>
                    <li class="flex items-center p-6 bg-white rounded-lg shadow-lg">
                        <i class='bx bxs-user-check text-orange-500 text-4xl mr-4'></i>
                        <div class="text">
                            <h3 class="text-xl font-semibold text-gray-700">Content Here</h3>
                        </div>
                    </li>
                    <li class="flex items-center p-6 bg-white rounded-lg shadow-lg">
                        <i class='bx bxs-user-check text-green-500 text-4xl mr-4'></i>
                        <div class="text">
                            <h3 class="text-xl font-semibold text-gray-700">Content Here</h3>
                        </div>
                    </li>
                </ul>

                <!-- Charts Container -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <canvas id="chart1"></canvas>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <canvas id="chart2"></canvas>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <canvas id="chart3"></canvas>
                    </div>
                </div>

                <!-- Announcements Table -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-bell text-yellow-500 text-2xl mr-2"></i> Announcements Table
                </h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto" id="announcementsTable">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="px-4 py-2">Date</th>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Description</th>
                                <th class="px-4 py-2">Document</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white text-gray-700" id="tableBody">
                            <!-- Table rows will be injected here -->
                        </tbody>
                    </table>
                </div>
                <!-- Pagination Controls -->
                <div class="flex justify-center mt-4" id="paginationControls">
                    <!-- Pagination links will be injected here -->
                </div>
            </div>
                        </div>
                    </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <!-- CONTENT -->
    <?php
    // Fetch data for the first two charts
    $sql = "SELECT DATE_FORMAT(date_completed, '%Y-%m') AS month, COUNT(*) AS task_count 
        FROM employee_tasks 
        WHERE status = 2  
        GROUP BY month 
        ORDER BY month";

    $result = $conn->query($sql);

    $months = [];
    $taskCounts = [];

    while ($row = $result->fetch_assoc()) {
        $months[] = date('F Y', strtotime($row['month'] . '-01'));
        $taskCounts[] = $row['task_count'];
    }

    // Fetch data for the pie chart
    $pieSql = "SELECT status, COUNT(*) AS task_count FROM employee_tasks GROUP BY status";
    $pieResult = $conn->query($pieSql);

    $pieLabels = [];
    $pieData = [];

    while ($row = $pieResult->fetch_assoc()) {
        $status = ($row['status'] == 1) ? 'Pending' : (($row['status'] == 2) ? 'Completed' : 'Not Started');
        $pieLabels[] = $status;
        $pieData[] = $row['task_count'];
    }
    ?>
<script>
        var months = <?php echo json_encode($months); ?>;
        var taskCounts = <?php echo json_encode($taskCounts); ?>;
        var pieLabels = <?php echo json_encode($pieLabels); ?>;
        var pieData = <?php echo json_encode($pieData); ?>;

        // Bar Chart
        var ctx1 = document.getElementById('chart1').getContext('2d');
var gradientFill = ctx1.createLinearGradient(0, 0, 0, 400);
gradientFill.addColorStop(0, 'rgba(75, 192, 192, 0.4)');
gradientFill.addColorStop(1, 'rgba(75, 192, 192, 0.1)');

var chart1 = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: months,
        datasets: [{
            label: 'Completed Tasks',
            data: taskCounts,
            backgroundColor: gradientFill,
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2,
            borderRadius: 10, // Rounded bars
        }]
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 15,
                right: 15,
                top: 15,
                bottom: 15
            }
        },
        scales: {
            x: {
                beginAtZero: true,
                grid: {
                    display: false,
                },
                ticks: {
                    color: '#333',
                }
            },
            y: {
                beginAtZero: true,
                grid: {
                    color: '#ddd',
                },
                ticks: {
                    color: '#333',
                }
            }
        },
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    color: '#333',
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                }
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw + ' tasks';
                    }
                }
            }
        }
    }
});

        // Line Chart
        // Line Chart
var ctx2 = document.getElementById('chart2').getContext('2d');
var gradientStroke = ctx2.createLinearGradient(0, 0, 0, 400);
gradientStroke.addColorStop(0, 'rgba(75, 192, 192, 1)');
gradientStroke.addColorStop(1, 'rgba(75, 192, 192, 0.3)');

var chart2 = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: months,
        datasets: [{
            label: 'Completed Tasks',
            data: taskCounts,
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: gradientStroke,
            fill: true,
            tension: 0.4, // Smooth curves
            borderWidth: 2
        }]
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 15,
                right: 15,
                top: 15,
                bottom: 15
            }
        },
        scales: {
            x: {
                beginAtZero: true,
                grid: {
                    display: false,
                },
                ticks: {
                    color: '#333',
                }
            },
            y: {
                beginAtZero: true,
                grid: {
                    color: '#ddd',
                },
                ticks: {
                    color: '#333',
                }
            }
        },
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    color: '#333',
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                }
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw + ' tasks';
                    }
                }
            }
        }
    }
});


        // Pie Chart
var ctx3 = document.getElementById('chart3').getContext('2d');
var chart3 = new Chart(ctx3, {
    type: 'pie',
    data: {
        labels: pieLabels,
        datasets: [{
            label: 'Task Status Distribution',
            data: pieData,
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)', // Red
                'rgba(75, 192, 192, 0.8)', // Green
                'rgba(255, 206, 86, 0.8)', 
            ],
            borderColor: '#fff',
            borderWidth: 2,
        }]
    },
    options: {
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    color: '#333',
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                }
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw + ' tasks';
                    }
                }
            }
        }
    }
});
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    function loadTable(page) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'dashboard/fetch_announcements.php?page=' + page, true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                var response = JSON.parse(xhr.responseText);
                document.getElementById('tableBody').innerHTML = response.rows;
                document.getElementById('paginationControls').innerHTML = response.pagination;
            }
        };
        xhr.send();
    }

    // Load the initial page
    loadTable(1);

    // Delegate event handler to handle pagination links
    document.getElementById('paginationControls').addEventListener('click', function(e) {
        if (e.target && e.target.matches('a[data-page]')) {
            e.preventDefault();
            var page = e.target.getAttribute('data-page');
            loadTable(page);
        }
    });
});
</script>
    <script src="../script.js"></script>
</body>

</html>