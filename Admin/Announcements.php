<?php
session_start();
include("../connection.php");

// Retrieve the school_id from the session
$school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : 'Not logged in';

// Optionally check if the user is logged in based on session
if ($school_id === 'Not logged in') {
    header("Location: login.php?error=Please log in first");
    exit();
}

// Fetch announcements from the database
$sql = "SELECT * FROM announcements";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching data: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDO Batac LRMS</title>
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
        .title-column {
            width: 300px; /* Adjust the width as needed */
            word-wrap: break-word; /* Ensure text wraps within the cell */
        }
        .description-column {
            width: 500px; /* Adjust the width as needed */
            word-wrap: break-word; /* Ensure text wraps within the cell */
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
                <h1>Announcements<hr></h1>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addAnnouncementModal">Add Announcement</a>
                <button id="export-button" class="btn btn-secondary">Export to Excel</button>
            </div>
        </div>
        
            <!-- Table -->
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="title-column">Title</th>
                        <th class="description-column">Description</th>
                        <th>Date Posted</th>
                        <th>Status</th>
                        <th>Document</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $status = $row['status'] == 1 ? 'Active' : 'Inactive';
            $file_name = htmlspecialchars($row['file_name']);
            $id = htmlspecialchars($row['id']);
            $title = htmlspecialchars($row['title']);
            $description = htmlspecialchars($row['description']);
            $date_posted = htmlspecialchars($row['date_posted']);
            $status_value = htmlspecialchars($row['status']);
            
            // Determine if the file link should be displayed
            $file_link = !empty($file_name) 
                ? "<a href='../../Project/Announcements/{$file_name}' class='btn btn-info btn-sm' target='_blank'>View File</a>"
                : "No File";
            echo "<tr>
                <td>{$id}</td>
                <td class='title-column'>{$title}</td>
                <td class='description-column'>{$description}</td>
                <td>{$date_posted}</td>
                <td>{$status}</td>
                <td>{$file_link}</td>
                <td>
                    <a href='#' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editAnnouncementModal' data-id='{$id}' data-title='{$title}' data-description='{$description}' data-date_posted='{$date_posted}' data-status='{$status_value}' data-file_name='{$file_name}'>Edit</a>
                    <a href='#' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#removeAnnouncementModal' data-id='{$id}'>Remove</a>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No announcements found</td></tr>";
    }
    ?>
</tbody>
            </table>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->

<!-- Modals -->

<!-- Add Announcement Modal -->
<div class="modal fade" id="addAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="addAnnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAnnouncementModalLabel">Add New Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="announce/add_announcements.php" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="datePosted">Date Posted</label>
                    <input type="date" class="form-control" id="datePosted" name="date_posted" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="1">Active</option>
                        <option value="2">Inactive </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="taskFiles">Upload Files</label>
                    <input type="file" class="form-control-file" id="taskFiles" name="task_files[]" multiple>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Announcement</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Edit Announcement Modal -->
<div class="modal fade" id="editAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="editAnnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAnnouncementModalLabel">Edit Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="announce/edit_announcement.php" method="post" enctype="multipart/form-data">
    <div class="modal-body">
        <input type="hidden" id="edit-id" name="id">
        <div class="form-group">
            <label for="edit-title">Title</label>
            <input type="text" class="form-control" id="edit-title" name="title" required>
        </div>
        <div class="form-group">
            <label for="edit-description">Description</label>
            <textarea class="form-control" id="edit-description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="edit-datePosted">Date Posted</label>
            <input type="date" class="form-control" id="edit-datePosted" name="date_posted" required>
        </div>
        <div class="form-group">
            <label for="edit-status">Status</label>
            <select class="form-control" id="edit-status" name="status">
                <option value="1">Active</option>
                <option value="2">Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <label for="edit-taskFiles">Upload Files</label>
            <input type="file" class="form-control-file" id="edit-taskFiles" name="task_files[]" multiple>
            <p id="edit-file-name"></p> <!-- To show current file name or status -->
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
</form>
        </div>
    </div>
</div>

<!-- Remove Announcement Modal -->
<div class="modal fade" id="removeAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="removeAnnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeAnnouncementModalLabel">Remove Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove this announcement?</p>
            </div>
            <div class="modal-footer">
                <form action="announce/remove_announcement.php" method="post">
                    <input type="hidden" id="remove-id" name="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Remove</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#editAnnouncementModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var title = button.data('title');
    var description = button.data('description');
    var date_posted = button.data('date_posted');
    var status = button.data('status');
    var file_name = button.data('file_name');
    
    var modal = $(this);
    modal.find('#edit-id').val(id);
    modal.find('#edit-title').val(title);
    modal.find('#edit-description').val(description);
    modal.find('#edit-datePosted').val(date_posted);
    modal.find('#edit-status').val(status);
    // File name cannot be set directly; you might want to show the current file name or provide a link.
    modal.find('#edit-file-name').text(file_name ? file_name : 'No file');
});

    $('#removeAnnouncementModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        
        var modal = $(this);
        modal.find('#remove-id').val(id);
    });
</script>
<script src="../script.js"></script>
</body>
</html>
