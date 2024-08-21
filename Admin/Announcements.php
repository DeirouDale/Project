<?php
include("../connection.php");

// Pagination variables
$records_per_page = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $records_per_page;

// Fetch total number of announcements
$total_sql = "SELECT COUNT(*) AS total FROM announcements";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $records_per_page);

// Fetch announcements for the current page
$sql = "SELECT * FROM announcements LIMIT $offset, $records_per_page";
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
        <style>
        #content main .box-info-4 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
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

        /* Table container */
        .table-container {
            background: var(--light);
            padding: 24px;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 100%; /* Prevent exceeding container's width */
            box-sizing: border-box; /* Include padding and border in element's total width and height */
            overflow: hidden; /* Prevent content overflow */
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
                /* Pagination Styles */
                .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            margin: 0 5px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: black;
        }

        .pagination a.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .pagination a:hover {
            background-color: lightgrey;
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
            
        
            <!-- Table -->
            <div class="table-container">
                <h2>Created Announcments</h2>
                <hr>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addAnnouncementModal">Add Announcement</a>
                <button id="export-button" class="btn btn-secondary">Export to Excel</button>
                <hr>
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
                
                <!-- Pagination -->
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?php echo $page - 1; ?>">Previous</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <a href="?page=<?php echo $page + 1; ?>">Next</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
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
