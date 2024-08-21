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

    <?php include '../Admin/constants/style.php'; ?>
    <style>
        #content main .box-info-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 24px;
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

        #content main .dashboard-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-gap: 24px;
            margin-top: 36px;
        }

        /* Calendar container */
        .calendar-container {
            background: var(--light);
            padding: 24px;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            height: 600px; /* Match the calendar's height */
            max-width: 100%; /* Prevent exceeding container's width */
            box-sizing: border-box; /* Include padding and border in element's total width and height */
        }


        /* Charts container */
        .charts-container {
            display: grid;
            grid-template-rows: 1fr 1fr;
            grid-gap: 24px;
        }

        /* Style for individual charts */
        .chart-box {
            background: var(--light);
            padding: 24px;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Full calendar style */
        #calendar {
            height: 500px; /* Fixed height */
            width: 100%; /* Full width of its container */
            max-width: 100%; /* Prevent exceeding container's width */
            box-sizing: border-box; /* Include padding and border in element's total width and height */
            overflow: hidden; /* Prevent content overflow */
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
            <div class="container-Dashboard" id="Dashboard">
                <div class="head-title" id="name2">
                    <div class="left">
                        <h1>Reports</h1>
                    </div>
                    <hr>

                    <ul class="box-info-4">
                        <li>
                            <i class='bx bxs-group'></i>
                            <span class="text">
                                <h3></h3>
                                <p>No. of Candidates</p>
                            </span>
                        </li>
                        <li>
                            <i class='bx bxs-check-square'></i>
                            <span class="text">
                                <p>Total Voters</p>
                            </span>
                        </li>
                        <li>
                            <i class='bx bxs-user-check'></i>
                            <span class="text">
                                <h3>%</h3>
                                <p>Turn out of Votes</p>
                            </span>
                        </li>
                        <li>
                            <i class='bx bxs-user-check'></i>
                            <span class="text">
                                <h3>%</h3>
                                <p>Turn out of Votes</p>
                            </span>
                        </li>
                    </ul>
                    <ul class="box-info-4">
                        <li>
                            <i class='bx bxs-group'></i>
                            <span class="text">
                                <h3></h3>
                                <p>No. of Candidates</p>
                            </span>
                        </li>
                        <li>
                            <i class='bx bxs-check-square'></i>
                            <span class="text">
                                <p>Total Voters</p>
                            </span>
                        </li>
                        <li>
                            <i class='bx bxs-user-check'></i>
                            <span class="text">
                                <h3>%</h3>
                                <p>Turn out of Votes</p>
                            </span>
                        </li>
                        <li>
                            <i class='bx bxs-user-check'></i>
                            <span class="text">
                                <h3>%</h3>
                                <p>Turn out of Votes</p>
                            </span>
                        </li>
                    </ul>

                    <div class="dashboard-layout">
                        <!-- Left: Event Calendar -->
                        <div class="calendar-container">
                            <div id="calendar"></div>
                        </div>

                        <!-- Right: Two charts -->
                        <div class="charts-container">
                            <div class="chart-box">
                                <canvas id="chart1"></canvas>
                            </div>
                            <div class="chart-box">
                                <canvas id="chart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script src="../script.js"></script>
    <script>
        // Initialize Chart.js for the charts
        var ctx1 = document.getElementById('chart1').getContext('2d');
        var chart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May'],
                datasets: [{
                    label: 'Dataset 1',
                    data: [12, 19, 3, 5, 2],
                    backgroundColor: 'rgba(75, 192, 192, 0.6)'
                }]
            }
        });

        var ctx2 = document.getElementById('chart2').getContext('2d');
        var chart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May'],
                datasets: [{
                    label: 'Dataset 2',
                    data: [5, 10, 15, 20, 25],
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false
                }]
            }
        });
    </script>
    <script>
       $(document).ready(function() {
           $('#calendar').fullCalendar();
       });
    </script>
</body>

</html>
