<?php
include("../connection.php");

// Number of items per page
$itemsPerPage = 10;

// Get current page number from the query string
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page <= 0) $page = 1;

// Calculate the offset
$offset = ($page - 1) * $itemsPerPage;

// Fetch employee tasks with limit and offset
$query = "SELECT * FROM employees LIMIT $itemsPerPage OFFSET $offset";
$result = mysqli_query($conn, $query);

// Fetch total number of tasks for pagination controls
$totalQuery = "SELECT COUNT(*) AS total FROM employees";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalTasks = $totalRow['total'];
$totalPages = ceil($totalTasks / $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../Admin/constants/style.php'; ?>
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
    <title>SDO Batac LRMS</title>
</head>
<body>

    <?php include("../Admin/constants/side_bar.php"); ?>

    <section id="content">
    <?php include("../Admin/constants/nav.php"); ?>	
        
        <main>
            <div class="container-Dashboard" id="Dashboard">
                <div class="head-title">
                    <div class="left">
                        <h1 id="table-title">Employee</h1>
                        <hr>
                    </div>
                </div>

                <div class="search-section d-flex justify-content-between">
                    
                </div>

                <div class="table-container">
    <h2>Employee Details</h2>
    <hr>
    <button id="add-employee-button" class="btn btn-primary" data-toggle="modal" data-target="#addEmployeeModal">Add Employee</button>
    <button id="export-button" class="btn btn-secondary">Export to Excel</button>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Department</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['employee_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['position']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['department']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['contact_number']) . "</td>";

                    // Check status and display the appropriate label
                    $statusLabel = $row['status'] == 1 ? 'Approved' : 'Not Approved';
                    echo "<td>" . htmlspecialchars($statusLabel) . "</td>";

                    echo "<td>
                            <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editEmployeeModal' data-id='" . htmlspecialchars($row['employee_id']) . "'>Edit</button>
                            <button class='btn btn-danger btn-sm' data-toggle='modal' data-target='#removeEmployeeModal' data-id='" . htmlspecialchars($row['employee_id']) . "'>Remove</button>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No employees found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    
    <!-- Pagination Controls -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>" class="btn btn-secondary">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" class="btn btn-secondary <?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>" class="btn btn-secondary">Next</a>
        <?php endif; ?>
    </div>
</div>

        </main>
    </section>

    <!-- Add Employee Modal -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addEmployeeForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addEmployeeId">Employee ID</label>
                            <input type="text" class="form-control" id="addEmployeeId" name="employee_id" required>
                        </div>
                        <div class="form-group">
                            <label for="addEmployeeName">Name</label>
                            <input type="text" class="form-control" id="addEmployeeName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="addEmployeePosition">Position</label>
                            <input type="text" class="form-control" id="addEmployeePosition" name="position" required>
                        </div>
                        <div class="form-group">
                            <label for="addEmployeeDepartment">Department</label>
                            <input type="text" class="form-control" id="addEmployeeDepartment" name="department" required>
                        </div>
                        <div class="form-group">
                            <label for="addEmployeeEmail">Email</label>
                            <input type="email" class="form-control" id="addEmployeeEmail" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="addEmployeeContact">Contact Number</label>
                            <input type="text" class="form-control" id="addEmployeeContact" name="contact_number" required>
                        </div>
                        <div class="form-group">
                        <label for="addEmployeeUsertype">User Type</label>
                        <select class="form-control" id="addEmployeeUsertype" name="usertype">
                            <option value="0">Employee</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Employee Modal -->
    <!-- Edit Employee Modal -->
<!-- Edit Employee Modal -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editEmployeeForm">
                <div class="modal-body">
                    <input type="hidden" id="editEmployeeId" name="employee_id">
                    <div class="form-group">
                        <label for="editEmployeeName">Name</label>
                        <input type="text" class="form-control" id="editEmployeeName" name="name">
                    </div>
                    <div class="form-group">
                        <label for="editEmployeePosition">Position</label>
                        <input type="text" class="form-control" id="editEmployeePosition" name="position" >
                    </div>
                    <div class="form-group">
                        <label for="editEmployeeDepartment">Department</label>
                        <input type="text" class="form-control" id="editEmployeeDepartment" name="department" >
                    </div>
                    <div class="form-group">
                        <label for="editEmployeeEmail">Email</label>
                        <input type="email" class="form-control" id="editEmployeeEmail" name="email" >
                    </div>
                    <div class="form-group">
                        <label for="editEmployeeContact">Contact Number</label>
                        <input type="text" class="form-control" id="editEmployeeContact" name="contact_number" >
                    </div>
                    <div class="form-group">
                        <label for="editEmployeeStatus">Status</label>
                        <select class="form-control" id="editEmployeeStatus" name="status">
                            <option value="0">Not Yet Approved</option>
                            <option value="1">Approved</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editEmployeeStatus">User Type</label>
                        <select class="form-control" id="editEmployeeUsertype" name="usertype">
                            <option value="0">Employee</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Remove Employee Modal -->
    <div class="modal fade" id="removeEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="removeEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeEmployeeModalLabel">Remove Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="removeEmployeeForm">
                    <div class="modal-body">
                        <p>Are you sure you want to remove this employee?</p>
                        <input type="hidden" id="removeEmployeeId" name="employee_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../script.js"></script>
    <script src="employee.js"></script>
</body>
</html>
