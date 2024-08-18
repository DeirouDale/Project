<?php
include("../connection.php");
$employeeQuery = "SELECT id, name FROM employees";
$employeeResult = $conn->query($employeeQuery);

// Check for query success
if (!$employeeResult) {
    die("Error fetching employee data: " . $conn->error);
}

// Fetch task details if an ID is provided
$taskId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$task = null;
if ($taskId > 0) {
    $taskQuery = "SELECT * FROM employee_tasks WHERE id = $taskId";
    $taskResult = $conn->query($taskQuery);
    if ($taskResult && $taskResult->num_rows > 0) {
        $task = $taskResult->fetch_assoc();
    } else {
        die("Task not found.");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Tasks Tracking</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php include("../Admin/constants/style.php"); ?>
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
        /* Add this to your existing CSS file or within a <style> tag */
        .description-column {
            width: 300px; /* Adjust the width as needed */
            word-wrap: break-word; /* Ensure text wraps within the cell */
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
    </style>
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
                <h1>Assign Tasks<hr>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addDocumentModal">Assign Task</a>
                <button id="export-button" class="btn btn-secondary">Export to Excel</button>
            </div>
            <div class="container mt-4">
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="description-column">Description</th>
                        <th>Employee Name</th>
                        <th>Date Assigned</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Document</th> <!-- New column header -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                        include("../connection.php");
                        // Fetch employee tasks from the database
                        $query = "SELECT * FROM employee_tasks";
                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td class='description-column'>" . htmlspecialchars($row['description']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['employee_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['date_assigned']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['deadline']) . "</td>";
                                echo "<td>";
                                if ($row['status'] == 1) {
                                    echo "Not Started";
                                } elseif ($row['status'] == 2) {
                                    echo "In Progress";
                                } elseif ($row['status'] == 3) {
                                    echo "Pending";
                                } else {
                                    echo "Unknown Status"; // In case status is not 1, 2, or 3
                                }
                                echo "</td>";
                                echo "<td>";
                                if (!empty($row['file_name'])) {
                                    echo '<a href="../../Project/Task_Files/' . htmlspecialchars($row['file_name']) . '" class="btn btn-info btn-sm" target="_blank">View File</a>';
                                } else {
                                    echo "No File";
                                }
                                echo "</td>";
                                echo '<td>
                                        <a href="#" class="btn btn-warning btn-sm edit-btn" 
                                        data-id="' . htmlspecialchars($row['id']) . '"
                                        data-name="' . htmlspecialchars($row['employee_name']) . '"
                                        data-description="' . htmlspecialchars($row['description']) . '"
                                        data-date-assigned="' . htmlspecialchars($row['date_assigned']) . '"
                                        data-deadline="' . htmlspecialchars($row['deadline']) . '"
                                        data-status="' . htmlspecialchars($row['status']) . '"
                                        data-file="' . htmlspecialchars($row['file_name']) . '"
                                        data-toggle="modal" data-target="#editDocumentModal">Edit</a>
                                        <a href="tasks/remove_tasks.php?id=' . htmlspecialchars($row['id']) . '" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeDocumentModal">Remove</a>
                                    </td>';
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No tasks found.</td></tr>";
                        }
                        ?>
                    </tbody>
            </table>
        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->

<!-- Modals -->

<!-- Add Document Modal -->
<div class="modal fade" id="addDocumentModal" tabindex="-1" role="dialog" aria-labelledby="addDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDocumentModalLabel">Add New Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="tasks/add_task.php" method="post" enctype="multipart/form-data">
    <div class="modal-body">
    <div class="form-group">
            <label for="employeeName">Employee Name</label>
            <select class="form-control" id="employeeName" name="employee_name" required>
                <option value="" disabled selected>Select an employee</option>
                <?php
                // Output options for the dropdown
                while ($row = $employeeResult->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Task Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="dateAssigned">Date Assigned</label>
            <input type="date" class="form-control" id="dateAssigned" name="date_assigned" required>
        </div>
        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="date" class="form-control" id="deadline" name="deadline" required>
        </div>
        <div class="form-group">
            <label for="taskFiles">Upload Files</label>
            <input type="file" class="form-control-file" id="taskFiles" name="task_files[]" multiple>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Task</button>
    </div>
</form>

        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editDocumentModal" tabindex="-1" role="dialog" aria-labelledby="editDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="tasks/update_task.php" method="post" enctype="multipart/form-data">
                <!-- Hidden input for Task ID -->
                <input type="hidden" id="editTaskId" name="id">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="editDocumentModalLabel">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editEmployeeName">Employee Name</label>
                        <select class="form-control" id="editEmployeeName" name="employee_name" required>
                            <option value="" disabled>Select an employee</option>
                            <?php
                            // Fetch employees to populate the select dropdown
                            $employeeResult = $conn->query("SELECT id, name FROM employees");
                            while ($row = $employeeResult->fetch_assoc()) {
                                echo '<option value="' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editDescription">Task Description</label>
                        <textarea class="form-control" id="editDescription" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editDateAssigned">Date Assigned</label>
                        <input type="date" class="form-control" id="editDateAssigned" name="date_assigned" required>
                    </div>
                    <div class="form-group">
                        <label for="editDeadline">Deadline</label>
                        <input type="date" class="form-control" id="editDeadline" name="deadline" required>
                    </div>
                    <div class="form-group">
                        <label for="editStatus">Status</label>
                        <select class="form-control" id="editStatus" name="status" required>
                            <option value="1">Not Started</option>
                            <option value="2">In Progress</option>
                            <option value="3">Pending</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editFile">File</label>
                        <p id="editFile"></p>
                        <input type="file" class="form-control-file" id="editTaskFiles" name="task_files[]" multiple>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Task</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Remove Document Modal -->
<div class="modal fade" id="removeDocumentModal" tabindex="-1" role="dialog" aria-labelledby="removeDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeDocumentModalLabel">Remove Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove this document?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="#" class="btn btn-danger" id="confirmRemoveButton">Remove</a>
            </div>
        </div>
    </div>
</div>

<!-- JS Script to handle removing tasks -->
<script>
    document.querySelectorAll('.btn-danger').forEach(function (button) {
        button.addEventListener('click', function () {
            var removeUrl = this.getAttribute('href');
            document.getElementById('confirmRemoveButton').setAttribute('href', removeUrl);
        });
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Attach click event to Edit buttons
    document.querySelectorAll('.btn-warning').forEach(function(button) {
        button.addEventListener('click', function() {
            var row = this.closest('tr');
            var id = row.querySelector('td:first-child').textContent.trim();
            var description = row.querySelector('td:nth-child(2)').textContent.trim();
            var employeeName = row.querySelector('td:nth-child(3)').textContent.trim();
            var dateAssigned = row.querySelector('td:nth-child(4)').textContent.trim();
            var deadline = row.querySelector('td:nth-child(5)').textContent.trim();

            // Populate modal fields
            document.getElementById('editTaskId').value = id;
            document.getElementById('editDescription').value = description;
            document.getElementById('editEmployeeName').value = employeeName;
            document.getElementById('editDateAssigned').value = dateAssigned;
            document.getElementById('editDeadline').value = deadline;
        });
    });
});
</script>
<script>$(document).ready(function () {
    // When the edit button is clicked
    $('.edit-btn').on('click', function () {
        // Get task data from the data attributes
        var taskId = $(this).data('id');
        var employeeName = $(this).data('name');
        var description = $(this).data('description');
        var dateAssigned = $(this).data('date-assigned');
        var deadline = $(this).data('deadline');
        var status = $(this).data('status');
        var file = $(this).data('file');

        // Populate the modal fields with the task data
        $('#editTaskId').val(taskId);
        $('#editEmployeeName').val(employeeName);
        $('#editDescription').val(description);
        $('#editDateAssigned').val(dateAssigned);
        $('#editDeadline').val(deadline);
        $('#editStatus').val(status);

        // Optionally, handle file display or editing
        $('#editFile').text(file);
    });
});

    </script>
<script src="../script.js"></script>

</body>
</html>
