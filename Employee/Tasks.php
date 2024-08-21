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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
    <?php include("../Employee/constants/style.php"); ?>
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
                <h1>Tasks<hr></h1>
            </div>
        </div>
        <div class="filter-form" style= "margin-bottom: 20px;">
            <form id="filterForm" method="GET" action="">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <label for="status" class="sr-only">Filter by Status:</label>
                        <select class="form-control mb-2" id="status" name="status">
                            <option value="">All</option>
                            <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') echo 'selected'; ?>> Pending</option>
                            <option value="2" <?php if (isset($_GET['status']) && $_GET['status'] == '2') echo 'selected'; ?>>Completed</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-2">Apply Filter</button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Two Cards in a Row -->
        <div id="taskList" class="row">
        <?php
        // Include the database connection
        include('../connection.php');

        // Get filter values
        $status_filter = isset($_GET['status']) ? $_GET['status'] : '';

        // Pagination variables
        $limit = 4; // Number of entries per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        // Construct SQL query with filtering and pagination
        $sql = "SELECT * FROM employee_tasks";
        if ($status_filter !== '') {
            $sql .= " WHERE status = " . $conn->real_escape_string($status_filter);
        }
        $sql .= " LIMIT $start, $limit";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($task = $result->fetch_assoc()) {
                // Format dates
                $start_date = date('d.m.y', strtotime($task['date_assigned']));
                $completion_date = date('d.m.y', strtotime($task['deadline']));
                $task_status = $task['status'];
                $submitted_on = !empty($task['date_completed']) ? date('d.m.y H:i', strtotime($task['date_completed'])) : null;
        ?>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="dates">
                                <p class="card-text"><strong>Assigned on:</strong> <?php echo $start_date; ?></p>
                                <p class="card-text"><strong>Deadline:</strong> <?php echo $completion_date; ?></p>
                                <p class="card-text">
                                    <?php if (!empty($task['file_name'])): ?>
                                        <a href="../Task_Files/<?php echo htmlspecialchars($task['file_name']); ?>" class="btn btn-success" download>
                                            Download File
                                        </a>
                                    <?php else: ?>
                                        <span>No File</span>
                                    <?php endif; ?>
                                </p>
                            </div>       
                            <div class="container" style = "margin-top: 10px; margin-bottom: 10px; ">
                            <h5 class="card-title"><?php echo htmlspecialchars($task['description']); ?></h5>
            </div>
                            <div class="dates">
                               
                                
                                <?php if ($task['status'] == 2): ?>
                                <p class="card-text"><strong>Submitted on:</strong> <?php echo $submitted_on; ?></p>
                                <!-- Button for editing turned-in tasks -->
                                <button class="turned-in-button" data-toggle="modal" data-target="#editTurnInModal" data-task-id="<?php echo htmlspecialchars($task['id']); ?>" data-comments="<?php echo htmlspecialchars($task['comments']); ?>" data-file-name="<?php echo htmlspecialchars($task['submitted_file']); ?>">
                                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                                    </svg>
                                    <span class="text">Edit Submission</span>
                                    <span class="circle"></span>
                                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                                    </svg>
                                </button>
                                
                            <?php elseif ($task['returned'] == 1): ?>
                                <!-- New condition for 'returned' status -->
                                <p class="card-text">
                                <span class="warning-sign" title="This task was returned. Please review it.">⚠️This task was returned.</span>
                            </p>
                            <!-- Button for handling returned tasks -->
                            <button class="animated-button" data-toggle="modal" data-target="#turnInModal" data-task-id="<?php echo htmlspecialchars($task['id']); ?>">
                                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                                </svg>
                                <span class="text">Turn In</span>
                                <span class="circle"></span>
                                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                                </svg>
                            </button>
                                
                            <?php else: ?>
                                <!-- Button when the task is still pending -->
                                <p></p>
                                <p></p>
                                <button class="animated-button" data-toggle="modal" data-target="#turnInModal" data-task-id="<?php echo htmlspecialchars($task['id']); ?>">
                                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                                    </svg>
                                    <span class="text">Turn In</span>
                                    <span class="circle"></span>
                                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                                    </svg>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        echo "<p>No tasks found.</p>";
    }

        // Get total number of tasks for pagination
        $count_sql = "SELECT COUNT(*) AS total FROM employee_tasks";
        if ($status_filter !== '') {
            $count_sql .= " WHERE status = " . $conn->real_escape_string($status_filter);
        }
        $count_result = $conn->query($count_sql);
        $total_tasks = $count_result->fetch_assoc()['total'];
        $total_pages = ceil($total_tasks / $limit);

        echo '</div class ="container">';
        echo ' <div class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            $active = ($i == $page) ? 'active' : '';
            echo '<a class="page-link" href="?page=' . $i . '&status=' . htmlspecialchars($status_filter) . '">' . $i . '</a>';
        }
        echo '</div>';
        echo '</div>';
        ?>
    </div>

</main>
    <!-- MAIN -->
</section>

<!-- Modal -->
<div class="modal fade" id="turnInModal" tabindex="-1" aria-labelledby="turnInModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="turnInModalLabel">Turn In Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="turnInForm" action="tasks/submit_task.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="task_id" id="task_id">
                <div class="form-group">
                    <label for="file">Upload File</label>
                    <input type="file" class="form-control-file" id="file" name="file" required>
                </div>
                <div class="form-group">
                    <label for="comments">Comments</label>
                    <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitTurnIn">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Turn In Modal -->
<div class="modal fade" id="editTurnInModal" tabindex="-1" aria-labelledby="editTurnInModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTurnInModalLabel">Edit Turned-In Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editTurnInForm" action="tasks/edit_submission.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="task_id" id="edit_task_id">
                    <div class="form-group">
                        <label for="edit_file">Update File (Leave blank to keep the current file)</label>
                        <input type="file" class="form-control-file" id="edit_file" name="file">
                    </div>
                    <div class="form-group">
                        <label for="edit_comments">Update Comments</label>
                        <textarea class="form-control" id="edit_comments" name="comments" rows="3"></textarea>
                    </div>
                    <p id="currentFileDisplay"><strong>Current File:</strong> <span id="currentFileName"></span></p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitEditTurnIn">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script src="../script.js"></script>

<script>
$(document).ready(function() {
    $('#turnInModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); 
        var taskId = button.data('task-id');
        var modal = $(this);
        modal.find('.modal-title').text('Turn In Task ID: ' + taskId);
        modal.find('#task_id').val(taskId);  // Set the hidden input value
    });

    $('#submitTurnIn').click(function() {
        $('#turnInForm').submit();  // Submit the form
    });
});

</script>
<script>
$(document).ready(function() {
    $('#editTurnInModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var taskId = button.data('task-id');
        var comments = button.data('comments');
        var fileName = button.data('file-name');
        var modal = $(this);

        // Set the hidden input value
        modal.find('#edit_task_id').val(taskId);

        // Set the comments and file name
        modal.find('#edit_comments').val(comments);
        modal.find('#currentFileName').text(fileName);
    });

    $('#submitEditTurnIn').click(function() {
        $('#editTurnInForm').submit();  // Submit the form
    });
});

</script>

</body>
</html>