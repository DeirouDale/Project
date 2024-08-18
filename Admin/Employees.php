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

        /* Container Styles for Table */
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
                        <h1 id="table-title">Employee Details</h1>
                        <hr>
                    </div>
                </div>

                <div class="search-section d-flex justify-content-between">
                    <button id="add-employee-button" class="btn btn-primary" data-toggle="modal" data-target="#addEmployeeModal">Add Employee</button>
                    <button id="export-button" class="btn btn-secondary">Export to Excel</button>
                </div>

                <div>
                    <table >
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
                    include("../connection.php");
                    $query = "SELECT * FROM employees";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['employee_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['position']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['department']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['contact_number']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
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
                        <input type="text" class="form-control" id="editEmployeeName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmployeePosition">Position</label>
                        <input type="text" class="form-control" id="editEmployeePosition" name="position" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmployeeDepartment">Department</label>
                        <input type="text" class="form-control" id="editEmployeeDepartment" name="department" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmployeeEmail">Email</label>
                        <input type="email" class="form-control" id="editEmployeeEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmployeeContact">Contact Number</label>
                        <input type="text" class="form-control" id="editEmployeeContact" name="contact_number" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmployeeStatus">Status</label>
                        <select class="form-control" id="editEmployeeStatus" name="status">
                            <option value="approved">Approved</option>
                            <option value="not yet approved">Not Yet Approved</option>
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