<?php
// Include your database connection
include('../connection.php');
// Query to fetch data for learners by program
$query = "SELECT * FROM learners_by_program";
$result = mysqli_query($conn, $query);
$tables = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDO Batac LRMS</title>
    <?php include("../Users/constants/style.php"); ?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body style="background: var(--grey); overflow-x: hidden;">
    <!-- SIDEBAR -->
    <?php include("../Users/constants/side_bar.php"); ?>

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <?php include("../Users/constants/nav.php"); ?>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main class="flex-1 p-6">
            <!-- Dashboard -->
            <div class="container-Dashboard" id="Dashboard">
                <div class="head-title" id="name2">
                    <div class="left">
                        <h1>Learners By Program</h1>
                    </div>
                    <hr>
                </div>

                <!-- Create Table Button -->
                <button style="margin-top:20px;" id="create-table-button" class="btn btn-success" data-toggle="modal" data-target="#dateModal">Create Table</button>
                
                <ul style="margin-top:20px;" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <?php foreach ($tables as $table): ?>
                        <li class="flex items-center p-6 bg-white rounded-lg shadow-lg" data-id="<?php echo $table['id']; ?>">
                            <i class='bx bx-table text-blue-600 text-4xl mr-4'></i>
                            <div class="text">
                                <h3 class="text-xl font-semibold text-gray-700">
                                    ID: <?php echo htmlspecialchars($table['id']); ?>
                                </h3>
                                <h3 class="text-xl font-semibold text-gray-700">
                                    Date: <?php echo htmlspecialchars($table['date']); ?>
                                </h3>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Modal for Date Selection -->
                <div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="dateModalLabel">Select Date</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="date-form">
                                    <div class="form-group">
                                        <label for="selected-date">Date</label>
                                        <input type="date" class="form-control" id="selected-date" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id="save-date-button" class="btn btn-primary">Save Date</button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php foreach ($tables as $table): ?>
                    <div class="table-container date-table" id="table-<?php echo htmlspecialchars($table['id']); ?>" style="display: none;">
        <table class="table">
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
                <td>Madrasah Education Program (MEP) - Muslim</td>
                <td id="upmepmuslimkindergartenmale" contenteditable="true"><?= htmlspecialchars($table['mepmuslimkindergartenmale']) ?></td>
                <td id="upmepmuslimkindergartenfemale" contenteditable="true"><?= htmlspecialchars($table['mepmuslimkindergartenfemale']) ?></td>
                <td id="upmepmuslimgrade1male" contenteditable="true"><?= htmlspecialchars($table['mepmuslimgrade1male']) ?></td>
                <td id="upmepmuslimgrade1female" contenteditable="true"><?= htmlspecialchars($table['mepmuslimgrade1female']) ?></td>
                <td id="upmepmuslimgrade2male" contenteditable="true"><?= htmlspecialchars($table['mepmuslimgrade2male']) ?></td>
                <td id="upmepmuslimgrade2female" contenteditable="true"><?= htmlspecialchars($table['mepmuslimgrade2female']) ?></td>
                <td id="upmepmuslimgrade3male" contenteditable="true"><?= htmlspecialchars($table['mepmuslimgrade3male']) ?></td>
                <td id="upmepmuslimgrade3female" contenteditable="true"><?= htmlspecialchars($table['mepmuslimgrade3female']) ?></td>
                <td id="upmepmuslimgrade4male" contenteditable="true"><?= htmlspecialchars($table['mepmuslimgrade4male']) ?></td>
                <td id="upmepmuslimgrade4female" contenteditable="true"><?= htmlspecialchars($table['mepmuslimgrade4female']) ?></td>
                <td id="upmepmuslimgrade5male" contenteditable="true"><?= htmlspecialchars($table['mepmuslimgrade5male']) ?></td>
                <td id="upmepmuslimgrade5female" contenteditable="true"><?= htmlspecialchars($table['mepmuslimgrade5female']) ?></td>
                <td id="upmepmuslimgrade6male" contenteditable="true"><?= htmlspecialchars($table['mepmuslimgrade6male']) ?></td>
                <td id="upmepmuslimgrade6female" contenteditable="true"><?= htmlspecialchars($table['mepmuslimgrade6female']) ?></td>
                <td id="uptotal_mepmuslimmale" contenteditable="true"><?= htmlspecialchars($table['total_mepmuslimmale']) ?></td>
                <td id="uptotal_mepmuslimfemale" contenteditable="true"><?= htmlspecialchars($table['total_mepmuslimfemale']) ?></td>
            </tr>
            <tr>
                <td>Madrasah Education Program (MEP) - Non-Muslim</td>
                <td id="upmepnonmuslimkindergartenmale" contenteditable="true"><?= htmlspecialchars($table['mepnonmuslimkindergartenmale']) ?></td>
                <td id="upmepnonmuslimkindergartenfemale" contenteditable="true"><?= htmlspecialchars($table['mepnonmuslimkindergartenfemale']) ?></td>
                <td id="upmepnonmuslimgrade1male" contenteditable="true"><?= htmlspecialchars($table['mepnonmuslimgrade1male']) ?></td>
                <td id="upmepnonmuslimgrade1female" contenteditable="true"><?= htmlspecialchars($table['mepnonmuslimgrade1female']) ?></td>
                <td id="upmepnonmuslimgrade2male" contenteditable="true"><?= htmlspecialchars($table['mepnonmuslimgrade2male']) ?></td>
                <td id="upmepnonmuslimgrade2female" contenteditable="true"><?= htmlspecialchars($table['mepnonmuslimgrade2female']) ?></td>
                <td id="upmepnonmuslimgrade3male" contenteditable="true"><?= htmlspecialchars($table['mepnonmuslimgrade3male']) ?></td>
                <td id="upmepnonmuslimgrade3female" contenteditable="true"><?= htmlspecialchars($table['mepnonmuslimgrade3female']) ?></td>
                <td id="upmepnonmuslimgrade4male" contenteditable="true"><?= htmlspecialchars($table['mepnonmuslimgrade4male']) ?></td>
                <td id="upmepnonmuslimgrade4female" contenteditable="true"><?= htmlspecialchars($table['mepnonmuslimgrade4female']) ?></td>
                <td id="upmepnonmuslimgrade5male" contenteditable="true"><?= htmlspecialchars($table['mepnonmuslimgrade5male']) ?></td>
                <td id="upmepnonmuslimgrade5female" contenteditable="true"><?= htmlspecialchars($table['mepnonmuslimgrade5female']) ?></td>
                <td id="upmepnonmuslimgrade6male" contenteditable="true"><?= htmlspecialchars($table['mepnonmuslimgrade6male']) ?></td>
                <td id="upmepnonmuslimgrade6female" contenteditable="true"><?= htmlspecialchars($table['mepnonmuslimgrade6female']) ?></td>
                <td id="uptotal_mepnonmuslimmale" contenteditable="true"><?= htmlspecialchars($table['total_mepnonmuslimmale']) ?></td>
                <td id="uptotal_mepnonmuslimfemale" contenteditable="true"><?= htmlspecialchars($table['total_mepnonmuslimfemale']) ?></td>
            </tr>
            <tr>
                <td>Special Science Elementary School (SSES)</td>
                <td colspan="2" class="black-cell"></td>
                <td id="upssesgrade1male" contenteditable="true"><?= htmlspecialchars($table['ssesgrade1male']) ?></td>
                <td id="upssesgrade1female" contenteditable="true"><?= htmlspecialchars($table['ssesgrade1female']) ?></td>
                <td id="upssesgrade2male" contenteditable="true"><?= htmlspecialchars($table['ssesgrade2male']) ?></td>
                <td id="upssesgrade2female" contenteditable="true"><?= htmlspecialchars($table['ssesgrade2female']) ?></td>
                <td id="upssesgrade3male" contenteditable="true"><?= htmlspecialchars($table['ssesgrade3male']) ?></td>
                <td id="upssesgrade3female" contenteditable="true"><?= htmlspecialchars($table['ssesgrade3female']) ?></td>
                <td id="upssesgrade4male" contenteditable="true"><?= htmlspecialchars($table['ssesgrade4male']) ?></td>
                <td id="upssesgrade4female" contenteditable="true"><?= htmlspecialchars($table['ssesgrade4female']) ?></td>
                <td id="upssesgrade5male" contenteditable="true"><?= htmlspecialchars($table['ssesgrade5male']) ?></td>
                <td id="upssesgrade5female" contenteditable="true"><?= htmlspecialchars($table['ssesgrade5female']) ?></td>
                <td id="upssesgrade6male" contenteditable="true"><?= htmlspecialchars($table['ssesgrade6male']) ?></td>
                <td id="upssesgrade6female" contenteditable="true"><?= htmlspecialchars($table['ssesgrade6female']) ?></td>
                <td id="uptotal_ssesmale" contenteditable="true"><?= htmlspecialchars($table['total_ssesmale']) ?></td>
                <td id="uptotal_ssesfemale" contenteditable="true"><?= htmlspecialchars($table['total_ssesfemale']) ?></td>
            </tr>
        </tbody>
    </table>
    <button id="save-changes" class="btn btn-primary">Save Changes</button>
</div>
<?php endforeach; ?>
             
                <!-- Table Content (Initially Hidden) -->
                <div class="table-container" id="learners-table" style="display: none;">
                    <table class="table">
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
                            <td>Madrasah Education Program (MEP) - Muslim</td>
                            <td id="mepmuslimkindergartenmale" contenteditable="true">0</td>
                            <td id="mepmuslimkindergartenfemale" contenteditable="true">0</td>
                            <td id="mepmuslimgrade1male" contenteditable="true">0</td>
                            <td id="mepmuslimgrade1female" contenteditable="true">0</td>
                            <td id="mepmuslimgrade2male" contenteditable="true">0</td>
                            <td id="mepmuslimgrade2female" contenteditable="true">0</td>
                            <td id="mepmuslimgrade3male" contenteditable="true">0</td>
                            <td id="mepmuslimgrade3female" contenteditable="true">0</td>
                            <td id="mepmuslimgrade4male" contenteditable="true">0</td>
                            <td id="mepmuslimgrade4female" contenteditable="true">0</td>
                            <td id="mepmuslimgrade5male" contenteditable="true">0</td>
                            <td id="mepmuslimgrade5female" contenteditable="true">0</td>
                            <td id="mepmuslimgrade6male" contenteditable="true">0</td>
                            <td id="mepmuslimgrade6female" contenteditable="true">0</td>
                            <td id="total_mepmuslimmale" contenteditable="true">0</td>
                            <td id="total_mepmuslimfemale" contenteditable="true">0</td>
                        </tr>
                        <tr>
                            <td>Madrasah Education Program (MEP) - Non-Muslim</td>
                            <td id="mepnonmuslimkindergartenmale" contenteditable="true">0</td>
                            <td id="mepnonmuslimkindergartenfemale" contenteditable="true">0</td>
                            <td id="mepnonmuslimgrade1male" contenteditable="true">0</td>
                            <td id="mepnonmuslimgrade1female" contenteditable="true">0</td>
                            <td id="mepnonmuslimgrade2male" contenteditable="true">0</td>
                            <td id="mepnonmuslimgrade2female" contenteditable="true">0</td>
                            <td id="mepnonmuslimgrade3male" contenteditable="true">0</td>
                            <td id="mepnonmuslimgrade3female" contenteditable="true">0</td>
                            <td id="mepnonmuslimgrade4male" contenteditable="true">0</td>
                            <td id="mepnonmuslimgrade4female" contenteditable="true">0</td>
                            <td id="mepnonmuslimgrade5male" contenteditable="true">0</td>
                            <td id="mepnonmuslimgrade5female" contenteditable="true">0</td>
                            <td id="mepnonmuslimgrade6male" contenteditable="true">0</td>
                            <td id="mepnonmuslimgrade6female" contenteditable="true">0</td>
                            <td id="total_mepnonmuslimmale" contenteditable="true">0</td>
                            <td id="total_mepnonmuslimfemale" contenteditable="true">0</td>
                        </tr>
                        <tr>
                            <td>Special Science Elementary School (SSES)</td>
                            <td colspan="2" class="black-cell"></td>
                            <td id="ssesgrade1male" contenteditable="true">0</td>
                            <td id="ssesgrade1female" contenteditable="true">0</td>
                            <td id="ssesgrade2male" contenteditable="true">0</td>
                            <td id="ssesgrade2female" contenteditable="true">0</td>
                            <td id="ssesgrade3male" contenteditable="true">0</td>
                            <td id="ssesgrade3female" contenteditable="true">0</td>
                            <td id="ssesgrade4male" contenteditable="true">0</td>
                            <td id="ssesgrade4female" contenteditable="true">0</td>
                            <td id="ssesgrade5male" contenteditable="true">0</td>
                            <td id="ssesgrade5female" contenteditable="true">0</td>
                            <td id="ssesgrade6male" contenteditable="true">0</td>
                            <td id="ssesgrade6female" contenteditable="true">0</td>
                            <td id="total_ssesmale" contenteditable="true">0</td>
                            <td id="total_ssesfemale" contenteditable="true">0</td>
                        </tr>
                    </tbody>
                    </table>
                    <button id="save-button" class="btn btn-primary" style="display: none;">Save Changes</button>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript -->
    <script>
    document.getElementById('save-date-button').addEventListener('click', function() {
        // Get the selected date
        const selectedDate = document.getElementById('selected-date').value;

        if (selectedDate) {
            // Close the modal
            $('#dateModal').modal('hide');

            // Display the table
            document.getElementById('learners-table').style.display = 'block';

            // Display the save button
            document.getElementById('save-button').style.display = 'inline-block';
        } else {
            alert('Please select a date.');
        }
    });

    document.getElementById('save-button').addEventListener('click', function() {
        // Collect data from all editable cells
        let data = {};
        document.querySelectorAll('[contenteditable="true"]').forEach(cell => {
            data[cell.id] = cell.innerText;
        });

        // Include the selected date in the data
        data['date'] = document.getElementById('selected-date').value;

        // Send data to the server using AJAX
        fetch('tfunctions/table_1_function.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('Changes saved successfully.');
            } else {
                alert('Failed to save changes.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while saving changes.');
        });
    });

    </script>
        <script>
    document.querySelectorAll('.grid li').forEach(container => {
        container.addEventListener('click', function() {
            // Hide all tables
            document.querySelectorAll('.date-table').forEach(table => {
                table.style.display = 'none';
            });
            
            // Show the selected table
            const tableId = this.getAttribute('data-id');
            const tableToShow = document.getElementById('table-' + tableId);
            if (tableToShow) {
                tableToShow.style.display = 'block';
            }
        });
    });

    </script>
    <script>
   document.getElementById('save-changes').addEventListener('click', function() {
    // Get the ID of the table
    const tableContainer = document.querySelector('.table-container.date-table');
    const tableId = tableContainer ? tableContainer.id.replace('table-', '') : '';

    // Collect data from all editable cells using a more efficient approach
    const editableCells = [
        'upmepmuslimkindergartenmale', 'upmepmuslimkindergartenfemale',
        'upmepmuslimgrade1male', 'upmepmuslimgrade1female',
        'upmepmuslimgrade2male', 'upmepmuslimgrade2female',
        'upmepmuslimgrade3male', 'upmepmuslimgrade3female',
        'upmepmuslimgrade4male', 'upmepmuslimgrade4female',
        'upmepmuslimgrade5male', 'upmepmuslimgrade5female',
        'upmepmuslimgrade6male', 'upmepmuslimgrade6female',
        'uptotal_mepmuslimmale', 'uptotal_mepmuslimfemale',
        'upmepnonmuslimkindergartenmale', 'upmepnonmuslimkindergartenfemale',
        'upmepnonmuslimgrade1male', 'upmepnonmuslimgrade1female',
        'upmepnonmuslimgrade2male', 'upmepnonmuslimgrade2female',
        'upmepnonmuslimgrade3male', 'upmepnonmuslimgrade3female',
        'upmepnonmuslimgrade4male', 'upmepnonmuslimgrade4female',
        'upmepnonmuslimgrade5male', 'upmepnonmuslimgrade5female',
        'upmepnonmuslimgrade6male', 'upmepnonmuslimgrade6female',
        'uptotal_mepnonmuslimmale', 'uptotal_mepnonmuslimfemale',
        'upssesgrade1male', 'upssesgrade1female',
        'upssesgrade2male', 'upssesgrade2female',
        'upssesgrade3male', 'upssesgrade3female',
        'upssesgrade4male', 'upssesgrade4female',
        'upssesgrade5male', 'upssesgrade5female',
        'upssesgrade6male', 'upssesgrade6female',
        'uptotal_ssesmale', 'uptotal_ssesfemale'
    ];

    // Build the data object dynamically
    let data = { tableId: tableId };
    editableCells.forEach(cellId => {
        const cellElement = document.getElementById(cellId);
        if (cellElement) {
            data[cellId] = cellElement.innerText.trim();
        }
    });

    // Send data to the server using AJAX
    fetch('tfunctions/t1update.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            alert('Changes saved successfully.');
        } else {
            alert('Failed to save changes: ' + (result.message || 'Unknown error.'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while saving changes.');
    });
});

</script>

</body>

</html>
