<?php
include '../../connection.php'; // Include your database connection file

$schoolQuery = "SELECT school_id, school_name FROM schools";
$schoolResult = $conn->query($schoolQuery);

// Fetch year options
$yearQuery = "SELECT DISTINCT year FROM `1`";
$yearResult = $conn->query($yearQuery);

// Get selected filters
$school_id = $_GET['school_id'] ?? '';
$year = $_GET['year'] ?? '2023-2024';

// Fetch available month-day combinations for the selected year and school
$monthDayQuery = "SELECT DISTINCT month, day FROM `1` WHERE school_id = ? AND year = ?";
$stmt = $conn->prepare($monthDayQuery);
$stmt->bind_param('ss', $school_id, $year);
$stmt->execute();
$monthDayResult = $stmt->get_result();

$monthDayOptions = [];
while ($row = $monthDayResult->fetch_assoc()) {
    $monthDayOptions[] = [
        'month' => str_pad($row['month'], 2, '0', STR_PAD_LEFT),
        'day' => str_pad($row['day'], 2, '0', STR_PAD_LEFT)
    ];
}

// Get selected month and day
$month = $_GET['month'] ?? '';
$day = $_GET['day'] ?? '';

// Fetch table data based on selected filters
$query = "SELECT * FROM `1` WHERE school_id = ? AND year = ? AND month = ? AND day = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ssss', $school_id, $year, $month, $day);
$stmt->execute();
$data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="../../style3.css">
    <title>SDO Batac LRMS</title>
    <style>
        .year-button {
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
            border: none;
            background-color: #007BFF;
            color: #fff;
            border-radius: 5px;
        }
        .year-button:hover {
            background-color: #0056b3;
        }
        .black-cell {
            background-color: black;
        }

        .search-section {
            display: flex;
            align-items: center; /* Align items vertically center */
            gap: 15px; /* Space between elements */
            margin: 20px 0; /* Space below the search section */
        }

        .search-section select, 
        .search-section button {
            padding: 10px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px; /* Font size for better readability */
        }

        .search-section button {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s; /* Smooth transition for hover effect */
        }

        .search-section button:hover {
            background-color: #0056b3; /* Darker color on hover */
        }

        #table-title {
            font-size: 1.5em; /* Adjust the size of the title text */
            color: #333; /* Change the color if needed */
            margin-bottom: 10px; /* Space below the title */
        }

        #table-title br {
            display: none; /* Hide the line break if you want to keep everything on one line */
        }

        .instructions {
            margin: 10px 0;
            font-size: 26px;
            color: #333;
        }

        .instructions p {
            margin-top: 0;
        }

        .instructions-date {
            margin: 10px 0;
            font-size: 18px;
            color: #333;
        }

        .instructions-date p {
            margin: 20px;
        }

        .export-buttons {
            margin: 20px 0;
        }
        .export-buttons button {
            margin-right: 10px;
        }
        .no-data {
            text-align: center;
            color: #ff0000; /* Red color for "No data available" message */
            font-size: 1.2em;
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs'> <img class="logo-img" src="../Img/icon.png" width="60px" height="60px" alt="Logo"></i>
            <span class="text">SGOD Batac</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="index.php">
                    <i class='bx bxs-home'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="active">
                <a href="Tables.php">
                    <i class='bx bxs-check-square'></i>
                    <span class="text">Tables</span>
                </a>
            </li>
            <li></li>
        </ul>
        <ul class="side-menu"></ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="hidden" placeholder="Search here">
                </div>
            </form>
        </nav>
        <!-- NAVBAR -->

        <!-- NAVBAR -->

        <main>
            <!-- Filters -->
           <div class="search-section">
            <label for="school-id">School:</label>
            <select id="school-id">
                <option value="">Select School</option>
                <?php while ($row = $schoolResult->fetch_assoc()): ?>
                    <option value="<?php echo $row['school_id']; ?>" <?php echo ($row['school_id'] == $school_id) ? 'selected' : ''; ?>>
                        <?php echo $row['school_name']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="year">Year:</label>
            <select id="year">
                <option value="">Select Year</option>
                <?php while ($row = $yearResult->fetch_assoc()): ?>
                    <option value="<?php echo $row['year']; ?>" <?php echo ($row['year'] == $year) ? 'selected' : ''; ?>>
                        <?php echo $row['year']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="month-day">Month-Day:</label>
            <select id="month-day">
                <option value="">Select Month-Day</option>
                <?php foreach ($monthDayOptions as $option): ?>
                    <option value="<?php echo $option['month'] . '-' . $option['day']; ?>" <?php echo ($option['month'] == $month && $option['day'] == $day) ? 'selected' : ''; ?>>
                        <?php echo $option['month'] . '-' . $option['day']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button class="year-button" onclick="applyFilters()">Search</button>
        </div>

            <!-- Table Headers -->
            <div class="container-Dashboard" id="Dashboard">
                <div class="head-title">
                    <div class="left">
                        <h1 id="table-title">Table 1. Learners by Program, SY <?php echo htmlspecialchars($year); ?></h1>
                        <hr>
                    </div>
                </div>
            </div>

            <!-- Enrollment by Program Table -->
            <div class="table-info" id="table-content">
                <?php if (empty($data)): ?>
                    <div class="no-data">No data available</div>
                <?php else: ?>
                    <table class="content-table">
                        <thead>
                            <tr>
                                <th rowspan="2">Enrollment by Program</th>
                                <th colspan="2">Kindergarten</th>
                                <th colspan="2">Grade 1</th>
                                <th colspan="2">Grade 2</th>
                                <th colspan="2">Grade 3</th>
                                <th colspan="2">Grade 4</th>
                                <th colspan="2">Grade 5</th>
                                <th colspan="2">Grade 6</th>
                                <th colspan="2">Total</th>
                            </tr>
                            <tr>
                                <th>Male</th>
                                <th>Female</th>
                                <th>Male</th>
                                <th>Female</th>
                                <th>Male</th>
                                <th>Female</th>
                                <th>Male</th>
                                <th>Female</th>
                                <th>Male</th>
                                <th>Female</th>
                                <th>Male</th>
                                <th>Female</th>
                                <th>Male</th>
                                <th>Female</th>
                                <th>Male</th>
                                <th>Female</th>
                            </tr>
                        </thead>
                        <tbody>
    <tr>
        <td>1. Madrasah Education Program (MEP)<br>Arabic Language and Islam Values Education (ALIVE)</td>
        <td colspan="16" class="black-cell"></td>
    </tr>
    <?php foreach ($data as $row): ?>
        <?php if ($row['program_name'] == 'Madrasah Education Program (MEP)'): ?>
            <tr>
                <td><?php echo $row['category'] == 'Muslim' ? '1.a Muslim' : '1.b Non-Muslim'; ?></td>
                <td><?php echo $row['kindergarten_male']; ?></td>
                <td><?php echo $row['kindergarten_female']; ?></td>
                <td><?php echo $row['grade1_male']; ?></td>
                <td><?php echo $row['grade1_female']; ?></td>
                <td><?php echo $row['grade2_male']; ?></td>
                <td><?php echo $row['grade2_female']; ?></td>
                <td><?php echo $row['grade3_male']; ?></td>
                <td><?php echo $row['grade3_female']; ?></td>
                <td><?php echo $row['grade4_male']; ?></td>
                <td><?php echo $row['grade4_female']; ?></td>
                <td><?php echo $row['grade5_male']; ?></td>
                <td><?php echo $row['grade5_female']; ?></td>
                <td><?php echo $row['grade6_male']; ?></td>
                <td><?php echo $row['grade6_female']; ?></td>
                <td><?php echo $row['total_male']; ?></td>
                <td><?php echo $row['total_female']; ?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>

    <tr>
        <td>2. Special Science Elementary School (SSES)</td>
        <td colspan="2" class="black-cell"></td>
        <?php 
        foreach ($data as $row) {
            if ($row['program_name'] == 'Special Science Elementary School (SSES)') {
                echo "<td>{$row['grade1_male']}</td>";
                echo "<td>{$row['grade1_female']}</td>";
                echo "<td>{$row['grade2_male']}</td>";
                echo "<td>{$row['grade2_female']}</td>";
                echo "<td>{$row['grade3_male']}</td>";
                echo "<td>{$row['grade3_female']}</td>";
                echo "<td>{$row['grade4_male']}</td>";
                echo "<td>{$row['grade4_female']}</td>";
                echo "<td>{$row['grade5_male']}</td>";
                echo "<td>{$row['grade5_female']}</td>";
                echo "<td>{$row['grade6_male']}</td>";
                echo "<td>{$row['grade6_female']}</td>";
                echo "<td>{$row['total_male']}</td>";
                echo "<td>{$row['total_female']}</td>";
            }
        }
        ?>
    </tr>
</tbody>
                    </table>
                <?php endif; ?>
            </div>
        </main>
    </section>

    <script>
        function applyFilters() {
            var school_id = document.getElementById('school-id').value;
            var year = document.getElementById('year').value;
            var monthDay = document.getElementById('month-day').value;
            var [month, day] = monthDay.split('-');

            var url = `Table_1.php?school_id=${school_id}&year=${year}&month=${month}&day=${day}`;
            window.location.href = url;
        }

        document.addEventListener('DOMContentLoaded', function() {
            var urlParams = new URLSearchParams(window.location.search);
            var year = urlParams.get('year') || '2023-2024';
            document.getElementById('table-title').textContent = `Table 1. Learners by Program, SY ${year}`;
        });
    </script>
    <script src="../../script.js"></script>
</body>
</html>