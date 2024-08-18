
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDO Batac LRMS</title>
    <?php include("../Users/constants/style.php"); ?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <!-- SIDEBAR -->
    <?php include("../Users/constants/side_bar.php"); ?>

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <?php include("../Users/constants/nav.php"); ?>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <!-- Dashboard -->
            <div class="container-Dashboard" id="Dashboard">
                <div class="head-title" id="name2">
                    <div class="left">
                        <h1>Learners By Program</h1>
                    </div>
                    <hr>
					<button id="create-table-button" class="btn btn-primary">Create Enrollment Table</button>
                </div>

                <!-- Create Table Button -->
                

                <!-- Table Content (Initially Hidden) -->
                <div id="table-content" style="display: none;" class="table-responsive">
                <table class="table table-bordered">
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
                        <?php
                        include('../connection.php'); // Ensure you have the correct path to your connection file

                        // Define your query to fetch data
                        $sql = "SELECT * FROM learners_by_program";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>1. Madrasah Education Program (MEP)<br>Arabic Language and Islam Values Education (ALIVE)</td>";
                                echo "<td colspan='16' class='black-cell'></td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>1.a Muslim</td>";
                                echo "<td contenteditable='true'>{$row['mep_muslim_kindergarten_male']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_muslim_kindergarten_female']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_muslim_grade1_male']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_muslim_grade1_female']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_muslim_grade2_male']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_muslim_grade2_female']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_muslim_grade3_male']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_muslim_grade3_female']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_muslim_grade4_male']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_muslim_grade4_female']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_muslim_grade5_male']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_muslim_grade5_female']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_muslim_grade6_male']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_muslim_grade6_female']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_muslim_total_male']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_muslim_total_female']}</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>1.b Non-Muslim</td>";
                                echo "<td contenteditable='true'>{$row['mep_non_muslim_kindergarten_male']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_non_muslim_kindergarten_female']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_non_muslim_grade1_male']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_non_muslim_grade1_female']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_non_muslim_grade2_male']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_non_muslim_grade2_female']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_non_muslim_grade3_male']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_non_muslim_grade3_female']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_non_muslim_grade4_male']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_non_muslim_grade4_female']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_non_muslim_grade5_male']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_non_muslim_grade5_female']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_non_muslim_grade6_male']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_non_muslim_grade6_female']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_non_muslim_total_male']}</td>";
                                echo "<td contenteditable='true'>{$row['mep_non_muslim_total_female']}</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>2. Special Science Elementary School (SSES)</td>";
                                echo "<td colspan='2' class='black-cell'></td>";
                                echo "<td contenteditable='true'>{$row['sses_grade1_male']}</td>";
                                echo "<td contenteditable='true'>{$row['sses_grade1_female']}</td>";
                                echo "<td contenteditable='true'>{$row['sses_grade2_male']}</td>";
                                echo "<td contenteditable='true'>{$row['sses_grade2_female']}</td>";
                                echo "<td contenteditable='true'>{$row['sses_grade3_male']}</td>";
                                echo "<td contenteditable='true'>{$row['sses_grade3_female']}</td>";
                                echo "<td contenteditable='true'>{$row['sses_grade4_male']}</td>";
                                echo "<td contenteditable='true'>{$row['sses_grade4_female']}</td>";
                                echo "<td contenteditable='true'>{$row['sses_grade5_male']}</td>";
                                echo "<td contenteditable='true'>{$row['sses_grade5_female']}</td>";
                                echo "<td contenteditable='true'>{$row['sses_grade6_male']}</td>";
                                echo "<td contenteditable='true'>{$row['sses_grade6_female']}</td>";
                                echo "<td contenteditable='true'>{$row['sses_total_male']}</td>";
                                echo "<td contenteditable='true'>{$row['sses_total_female']}</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='16'>No data available</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                        </table>
                        <button id="save-button" class="btn btn-success mt-3">Save Changes</button>
                    </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../script.js"></script>
    <script>
document.getElementById('save-button').addEventListener('click', function() {
    const tableRows = document.querySelectorAll('tbody tr');
    const data = [];
    
    tableRows.forEach((row, index) => {
        const cells = row.querySelectorAll('td[contenteditable="true"]');
        const rowData = Array.from(cells).map(cell => cell.innerText);
        data.push(rowData);
    });

    // Sending data to the server
    fetch('upt1.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ data: data })
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            alert('Data saved successfully!');
        } else {
            alert('Error saving data.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving data.');
    });
});

</script>



    <!-- Modal HTML -->
    <div class="modal fade" id="createTableModal" tabindex="-1" role="dialog" aria-labelledby="createTableModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTableModalLabel">Create Enrollment Table</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create-table-form">
                        <div class="form-group">
                            <label for="submitter-name">Name</label>
                            <input type="text" class="form-control" id="submitter-name" placeholder="Enter your name" required>
                        </div>
                        <div class="form-group">
                            <label for="calendar">Date</label>
                            <input type="date" class="form-control" id="calendar" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Table</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('create-table-button').addEventListener('click', function() {
            $('#createTableModal').modal('show');
        });

        document.getElementById('create-table-form').addEventListener('submit', function(event) {
            event.preventDefault();
            document.getElementById('table-content').style.display = 'block';
            document.getElementById('create-table-button').style.display = 'none';
            $('#createTableModal').modal('hide');
        });
    </script>
</body>

</html>
