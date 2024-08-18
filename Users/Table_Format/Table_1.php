<?php
include("sessions_1.php");
include("../../connection.php");

// Query to get all records from the '1' table
$query = "SELECT * FROM `1`";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

// Initialize an array to group tables by date
$groupedTables = [];

// Fetch all records into an array
while ($row = mysqli_fetch_assoc($result)) {
    $dateKey = $row['month'] . '-' . $row['day'] . ' SY:' . $row['year'];
    if (!isset($groupedTables[$dateKey])) {
        $groupedTables[$dateKey] = [];
    }
    $groupedTables[$dateKey][] = $row;
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<?php include("../../Users/constants/head.php"); ?>
<body>
    <!-- SIDEBAR -->
    <?php include("../../Users/constants/side_bar_tables.php"); ?>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <?php include("../../Users/constants/nav.php"); ?>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
        <div class="head-title" id="name2">
            <div class="left">
            <h1 id="create-table-header">Created Tables</h1>
            </div>
        </div>
        <ul class="box-info">
    <?php foreach ($groupedTables as $date => $tables): ?>
        <li>
            <i class='bx bx-table'></i>
            <span class="text">
                <p>Date: <?php echo htmlspecialchars($date); ?></p>
            </span>
        </li>
    <?php endforeach; ?>
</ul>
<hr>
                <button id="create-table-btn" class="btn btn-primary">Create Table</button>
                
                <?php include("../../Users/constants/table_1.php"); ?>

                <!-- Table Container -->
                <div class="container-Dashboard mt-4" id="Dashboard" style="display: none;">
                    <div class="head-title">
                        <div class="left">
                            <h1 id="table-title">
                                Table 1. Learners by Program, SY <span id="year-display"></span>
                                <br>As of <span id="month-display"></span> <span id="day-display"></span>
                            </h1>
                            <hr>
                        </div>
                    </div>
                    <div class="search-section">
                        <button id="back-button" class="btn btn-primary ms-2">Back</button>
                        <button id="export-button" class="btn btn-secondary">Export to Excel</button>
                    </div>


                    <div class="table-info" id="table-content">
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
                                        <td contenteditable="true" data-name="kindergarten_male" data-id="<?php echo $row['id']; ?>"><?php echo $row['kindergarten_male']; ?></td>
                                        <td contenteditable="true" data-name="kindergarten_female" data-id="<?php echo $row['id']; ?>"><?php echo $row['kindergarten_female']; ?></td>
                                        <td contenteditable="true" data-name="grade1_male" data-id="<?php echo $row['id']; ?>"><?php echo $row['grade1_male']; ?></td>
                                        <td contenteditable="true" data-name="grade1_female" data-id="<?php echo $row['id']; ?>"><?php echo $row['grade1_female']; ?></td>
                                        <td contenteditable="true" data-name="grade2_male" data-id="<?php echo $row['id']; ?>"><?php echo $row['grade2_male']; ?></td>
                                        <td contenteditable="true" data-name="grade2_female" data-id="<?php echo $row['id']; ?>"><?php echo $row['grade2_female']; ?></td>
                                        <td contenteditable="true" data-name="grade3_male" data-id="<?php echo $row['id']; ?>"><?php echo $row['grade3_male']; ?></td>
                                        <td contenteditable="true" data-name="grade3_female" data-id="<?php echo $row['id']; ?>"><?php echo $row['grade3_female']; ?></td>
                                        <td contenteditable="true" data-name="grade4_male" data-id="<?php echo $row['id']; ?>"><?php echo $row['grade4_male']; ?></td>
                                        <td contenteditable="true" data-name="grade4_female" data-id="<?php echo $row['id']; ?>"><?php echo $row['grade4_female']; ?></td>
                                        <td contenteditable="true" data-name="grade5_male" data-id="<?php echo $row['id']; ?>"><?php echo $row['grade5_male']; ?></td>
                                        <td contenteditable="true" data-name="grade5_female" data-id="<?php echo $row['id']; ?>"><?php echo $row['grade5_female']; ?></td>
                                        <td contenteditable="true" data-name="grade6_male" data-id="<?php echo $row['id']; ?>"><?php echo $row['grade6_male']; ?></td>
                                        <td contenteditable="true" data-name="grade6_female" data-id="<?php echo $row['id']; ?>"><?php echo $row['grade6_female']; ?></td>
                                        <td class="total-cell" data-name="total_male" data-id="<?php echo $row['id']; ?>"><?php echo $row['total_male']; ?></td>
                                        <td class="total-cell" data-name="total_female" data-id="<?php echo $row['id']; ?>"><?php echo $row['total_female']; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <tr>
                                <td>2. Special Science Elementary School (SSES)</td>
                                <td colspan="2" class="black-cell"></td>
                                <?php 
                                foreach ($data as $row) {
                                    if ($row['program_name'] == 'Special Science Elementary School (SSES)') {
                                        echo "<td contenteditable='true' data-name='grade1_male' data-id='{$row['id']}'>{$row['grade1_male']}</td>";
                                        echo "<td contenteditable='true' data-name='grade1_female' data-id='{$row['id']}'>{$row['grade1_female']}</td>";
                                        echo "<td contenteditable='true' data-name='grade2_male' data-id='{$row['id']}'>{$row['grade2_male']}</td>";
                                        echo "<td contenteditable='true' data-name='grade2_female' data-id='{$row['id']}'>{$row['grade2_female']}</td>";
                                        echo "<td contenteditable='true' data-name='grade3_male' data-id='{$row['id']}'>{$row['grade3_male']}</td>";
                                        echo "<td contenteditable='true' data-name='grade3_female' data-id='{$row['id']}'>{$row['grade3_female']}</td>";
                                        echo "<td contenteditable='true' data-name='grade4_male' data-id='{$row['id']}'>{$row['grade4_male']}</td>";
                                        echo "<td contenteditable='true' data-name='grade4_female' data-id='{$row['id']}'>{$row['grade4_female']}</td>";
                                        echo "<td contenteditable='true' data-name='grade5_male' data-id='{$row['id']}'>{$row['grade5_male']}</td>";
                                        echo "<td contenteditable='true' data-name='grade5_female' data-id='{$row['id']}'>{$row['grade5_female']}</td>";
                                        echo "<td contenteditable='true' data-name='grade6_male' data-id='{$row['id']}'>{$row['grade6_male']}</td>";
                                        echo "<td contenteditable='true' data-name='grade6_female' data-id='{$row['id']}'>{$row['grade6_female']}</td>";
                                        echo "<td class='total-cell' data-name='total_male' data-id='{$row['id']}'>{$row['total_male']}</td>";
                                        echo "<td class='total-cell' data-name='total_female' data-id='{$row['id']}'>{$row['total_female']}</td>";
                                    }
                                }
                                ?>
                            </tr>
                        </tbody>
        </table>
        <button id="save-button" class="btn btn-success">Save Changes</button>
    </div>
                </div>
        </main>
    </section>
    <script src="../../script.js"></script>
    <script src="../user_scripts/table_1.js"></script>
                                
    <script>
document.addEventListener('DOMContentLoaded', function () {
    // Functionality for export button
    document.getElementById('export-button').addEventListener('click', function () {
        const table = document.querySelector('#table-content table');
        if (!table) return;

        // Create a workbook from the table
        const wb = XLSX.utils.table_to_book(table);

        // Get the table title and clean it for use as a filename
        const tableTitle = document.getElementById('table-title').innerText.replace(/<\/?[^>]+(>|$)/g, "");

        // Create a filename with the school name and table details
        const schoolName = "<?php echo $school_name; ?>";
        const year = "<?php echo $year; ?>";
        const month = "<?php echo $month; ?>";
        const day = "<?php echo $day; ?>";
        const fileName = `${schoolName} Table_1 Learners by Program SY ${year} As of ${month} ${day}.xlsx`;

        // Write the workbook to a file and trigger the download
        XLSX.writeFile(wb, fileName);
    });

    // Functionality for back button
    document.getElementById('back-button').addEventListener('click', function () {
        location.reload(); // Reloads the current page
    });
});
</script>

</body>
</html>
