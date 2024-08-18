<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php include '../Admin/constants/style.php'; ?>
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

        /* Status Overview Styles */
    .status-overview .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        border-radius: 8px;
        color: white;
        text-align: center;
        padding: 20px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .status-overview .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    /* Different background colors for each card */
    .card-total-applications {
        background-color: #007bff; /* Blue */
    }

    .card-validation-region {
        background-color: #17a2b8; /* Cyan */
    }

    .card-for-signature {
        background-color: #ffc107; /* Yellow */
    }

    .card-total-processed {
        background-color: #28a745; /* Green */
    }

    .card-in-progress-on-target {
        background-color: #6f42c1; /* Purple */
    }

    .card-in-progress-urgent {
        background-color: #dc3545; /* Red */
    }

    .card-returned {
        background-color: #fd7e14; /* Orange */
    }

    .card-withdrawn {
        background-color: #343a40; /* Dark Grey */
    }

    /* Text Styles */
    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1.25rem;
    }
    </style>
    <title>SDO Batac LRMS</title>
</head>
<body>

<!-- SIDEBAR -->
<?php include("../Admin/constants/side_bar.php"); ?>
<!-- SIDEBAR -->

<!-- CONTENT -->
<section id="content">
    <?php include("../Admin/constants/nav.php"); ?> 

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1 id="table-title">Dashboard</h1>
                <hr>
            </div>
        </div>
        <!-- Status Overview on Top -->
<div class="container mt-4 status-overview">
    <h2>Status Overview</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-3 card-total-applications">
                <div class="card-body">
                    <h5 class="card-title">Total Applications</h5>
                    <p class="card-text">500</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3 card-validation-region">
                <div class="card-body">
                    <h5 class="card-title">Validation Region</h5>
                    <p class="card-text">150</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3 card-for-signature">
                <div class="card-body">
                    <h5 class="card-title">For Signature</h5>
                    <p class="card-text">75</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3 card-total-processed">
                <div class="card-body">
                    <h5 class="card-title">Total Processed</h5>
                    <p class="card-text">200</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3 card-in-progress-on-target">
                <div class="card-body">
                    <h5 class="card-title">In Progress (On Target)</h5>
                    <p class="card-text">30</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3 card-in-progress-urgent">
                <div class="card-body">
                    <h5 class="card-title">In Progress (Urgent)</h5>
                    <p class="card-text">30</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3 card-returned">
                <div class="card-body">
                    <h5 class="card-title">Returned</h5>
                    <p class="card-text">30</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3 card-withdrawn">
                <div class="card-body">
                    <h5 class="card-title">Withdrawn</h5>
                    <p class="card-text">20</p>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Graphs Inline Horizontally -->
        <div class="container mt-4">
            <div class="graph-row">
                <div class="chart-container">
                    <h2>School Applications Bar Graph</h2>
                    <canvas id="barChart"></canvas>
                </div>
                <div class="chart-container">
                    <h2>School Applications Line Graph</h2>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Applications List Table in a Container -->
        <div class="container mt-4 table-container">
            <h2>Applications List</h2>
            <table>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">School</th>
                        <th scope="col">Application Type</th>
                        <th scope="col">Grade Level</th>
                        <th scope="col">Application Date</th>
                        <th scope="col">Target Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>BS in Agricultural and Biosystems Engineering</td>
                        <td>120</td>
                        <td>Approved</td>
                        <td>01/10/2024</td>
                        <td>02/20/2024</td>
                        <td>Processing</td>
                        <td>Edit | Remove</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>BS in Ceramics Engineering</td>
                        <td>85</td>
                        <td>Not Approved</td>
                        <td>01/15/2024</td>
                        <td>02/25/2024</td>
                        <td>Rejected</td>
                        <td>Edit | Remove</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>BS in Chemical Engineering</td>
                        <td>95</td>
                        <td>Approved</td>
                        <td>01/20/2024</td>
                        <td>02/28/2024</td>
                        <td>Approved</td>
                        <td>Edit | Remove</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->
<script src="../script.js"></script>
<script src="../Admin/scripts/charts.js"></script>
</body>
</html>
