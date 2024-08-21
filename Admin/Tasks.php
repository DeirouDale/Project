<?php
include("../connection.php");

// Fetch counts for not started and in-progress tasks
$notStartedQuery = "SELECT COUNT(*) AS count FROM employee_tasks WHERE status = 1";
$notStartedResult = $conn->query($notStartedQuery);
$notStartedCount = $notStartedResult->fetch_assoc()['count'];

$inProgressQuery = "SELECT COUNT(*) AS count FROM employee_tasks WHERE status = 2";
$inProgressResult = $conn->query($inProgressQuery);
$inProgressCount = $inProgressResult->fetch_assoc()['count'];

// Number of items per page
$itemsPerPage = 2;

// Pagination for Assign Tasks
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = ($page <= 0) ? 1 : $page;
$selectedEmployee = isset($_GET['employee']) ? $conn->real_escape_string($_GET['employee']) : '';
$offset = ($page - 1) * $itemsPerPage;

$assignTasksQuery = "SELECT * FROM employee_tasks WHERE status = 1";
if ($selectedEmployee) {
    $assignTasksQuery .= " AND employee_name = '$selectedEmployee'";
}
$assignTasksQuery .= " LIMIT $itemsPerPage OFFSET $offset";
$assignTasksResult = $conn->query($assignTasksQuery);

if (!$assignTasksResult) {
    die("Error fetching assign tasks data: " . $conn->error);
}

$totalAssignTasksQuery = "SELECT COUNT(*) AS total FROM employee_tasks WHERE status = 1";
if ($selectedEmployee) {
    $totalAssignTasksQuery .= " AND employee_name = '$selectedEmployee'";
}
$totalAssignTasksResult = $conn->query($totalAssignTasksQuery);
$totalAssignTasksRow = $totalAssignTasksResult->fetch_assoc();
$totalAssignTasks = $totalAssignTasksRow['total'];
$totalAssignPages = ceil($totalAssignTasks / $itemsPerPage);

// Pagination for Completed Tasks
$pageCompleted = isset($_GET['page_completed']) ? intval($_GET['page_completed']) : 1;
$pageCompleted = ($pageCompleted <= 0) ? 1 : $pageCompleted;
$selectedEmployeeCompleted = isset($_GET['employee_completed']) ? $conn->real_escape_string($_GET['employee_completed']) : '';
$offsetCompleted = ($pageCompleted - 1) * $itemsPerPage;

$completedTasksQuery = "SELECT * FROM employee_tasks WHERE status = 2";
if ($selectedEmployeeCompleted) {
    $completedTasksQuery .= " AND employee_name = '$selectedEmployeeCompleted'";
}
$completedTasksQuery .= " LIMIT $itemsPerPage OFFSET $offsetCompleted";
$completedTasksResult = $conn->query($completedTasksQuery);

if (!$completedTasksResult) {
    die("Error fetching completed tasks data: " . $conn->error);
}

$totalCompletedTasksQuery = "SELECT COUNT(*) AS total FROM employee_tasks WHERE status = 2";
if ($selectedEmployeeCompleted) {
    $totalCompletedTasksQuery .= " AND employee_name = '$selectedEmployeeCompleted'";
}
$totalCompletedTasksResult = $conn->query($totalCompletedTasksQuery);
$totalCompletedTasksRow = $totalCompletedTasksResult->fetch_assoc();
$totalCompletedTasks = $totalCompletedTasksRow['total'];
$totalCompletedPages = ceil($totalCompletedTasks / $itemsPerPage);
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php include("../Admin/constants/style.php"); ?>
   
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
                <h1>Tasks<hr>
            </div>
            <ul class="box-info-4">
                    <li>
                        <i class='bx bxs-check-square'></i>
                        <span class="text">
                            <h3><?php echo $notStartedCount; ?></h3>
                            <p>Pending Tasks</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-user-check'></i>
                        <span class="text">
                            <h3><?php echo $inProgressCount; ?></h3>
                            <p>Completed Tasks</p>
                        </span>
                    </li>
                </ul>
                <div class="table-container">
        <h2>Assign Tasks</h2>
        <hr>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addDocumentModal">Assign Task</a>
                        <button id="export-button" class="btn btn-secondary">Export to Excel</button>
                    <hr>
                <form method="get" class="form-inline mb-3">
            <div class="form-group">
                <label for="employeeFilter" class="mr-2">Filter by Employee:</label>
                <select class="form-control" id="employeeFilter" name="employee">
                    <option value="">All Employees</option>
                    <?php
                    $employeeResult = $conn->query("SELECT DISTINCT employee_name FROM employee_tasks WHERE status = 1");
                    while ($row = $employeeResult->fetch_assoc()) {
                        $selected = ($row['employee_name'] == $selectedEmployee) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($row['employee_name']) . '" ' . $selected . '>' . htmlspecialchars($row['employee_name']) . '</option>';
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-primary ml-2">Filter</button>
            </div>
        </form>
        <div style="overflow-x: auto; width: 100%;">
            <table>
                <thead>
                    <tr>
                        <th>Task #</th>
                        <th class="description-column">Description</th>
                        <th>Employee Name</th>
                        <th>Date Assigned</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Document</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($assignTasksResult && $assignTasksResult->num_rows > 0) {
                        while ($row = $assignTasksResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td class='description-column'>" . htmlspecialchars($row['description']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['employee_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['date_assigned']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['deadline']) . "</td>";
                            echo "<td>";
                            if ($row['status'] == 1) {
                                echo "Pending";
                            } elseif ($row['status'] == 2) {
                                echo "Completed";
                            } else {
                                echo "Unknown Status";
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
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>&employee=<?php echo urlencode($selectedEmployee); ?>">&laquo; Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalAssignPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>&employee=<?php echo urlencode($selectedEmployee); ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php if ($page < $totalAssignPages): ?>
                <a href="?page=<?php echo $page + 1; ?>&employee=<?php echo urlencode($selectedEmployee); ?>">Next &raquo;</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Completed Tasks Table -->
    <div class="table-container" style="margin-top: 20px;">
        <h2>Completed Task</h2>
        <hr>
        <!-- Employee Filter for Completed Tasks -->
        <form method="get" class="form-inline mb-3">
            <div class="form-group">
                <label for="employeeFilterCompleted" class="mr-2">Filter by Employee:</label>
                <select class="form-control" id="employeeFilterCompleted" name="employee_completed">
                    <option value="">All Employees</option>
                    <?php
                    $employeeResult = $conn->query("SELECT DISTINCT employee_name FROM employee_tasks WHERE status = 2");
                    while ($row = $employeeResult->fetch_assoc()) {
                        $selected = ($row['employee_name'] == $selectedEmployeeCompleted) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($row['employee_name']) . '" ' . $selected . '>' . htmlspecialchars($row['employee_name']) . '</option>';
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-primary ml-2">Filter</button>
            </div>
        </form>
        <div style="overflow-x: auto; width: 100%;">
            <table>
                <thead>
                    <tr>
                        <th>Task #</th>
                        <th class="description-column">Description</th>
                        <th>Employee Name</th>
                        <th>Submitted on</th>
                        <th>Document</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($completedTasksResult && $completedTasksResult->num_rows > 0) {
                        while ($row = $completedTasksResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td class='description-column'>" . htmlspecialchars($row['description']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['employee_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['date_completed']) . "</td>";
                            echo "<td>";
                            if (!empty($row['file_name'])) {
                                echo '<a href="../../Project/Task_Files/' . htmlspecialchars($row['file_name']) . '" class="btn btn-info btn-sm" target="_blank">View File</a>';
                            } else {
                                echo "No File";
                            }
                            echo "</td>";
                            echo '<td>
                                <a href="tasks/return_task.php?id=' . htmlspecialchars($row['id']) . '" class="btn btn-warning btn-sm">Return</a>
                                <a href="tasks/remove_tasks.php?id=' . htmlspecialchars($row['id']) . '" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeDocumentModal">Remove</a>
                            </td>';
                        }
                    } else {
                        echo "<tr><td colspan='8'>No tasks found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="pagination">
            <?php if ($pageCompleted > 1): ?>
                <a href="?page_completed=<?php echo $pageCompleted - 1; ?>&employee_completed=<?php echo urlencode($selectedEmployeeCompleted); ?>">&laquo; Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalCompletedPages; $i++): ?>
                <a href="?page_completed=<?php echo $i; ?>&employee_completed=<?php echo urlencode($selectedEmployeeCompleted); ?>" class="<?php echo ($i == $pageCompleted) ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php if ($pageCompleted < $totalCompletedPages): ?>
                <a href="?page_completed=<?php echo $pageCompleted + 1; ?>&employee_completed=<?php echo urlencode($selectedEmployeeCompleted); ?>">Next &raquo;</a>
            <?php endif; ?>
        </div>
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
                            // Fetch employees to populate the select dropdown
                            $employeeResult = $conn->query("SELECT id, name FROM employees");
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
                            <option value="1">Pending</option>
                            <option value="2">Completed</option>
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
