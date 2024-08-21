$(document).ready(function() {
    $('#removeEmployeeModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var employeeId = button.data('id');
        var modal = $(this);
        modal.find('#removeEmployeeId').val(employeeId);
    });

    $('#addEmployeeForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'add_employee.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#addEmployeeModal').modal('hide');
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + " - " + error);
            }
        });
    });

    $('#removeEmployeeForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'remove_employee.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#removeEmployeeModal').modal('hide');
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + " - " + error);
            }
        });
    });
    $('#editEmployeeForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: 'edit_employee.php',
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            $('#editEmployeeModal').modal('hide');
            location.reload();
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: " + status + " - " + error);
        }
    });
});

    $('#editEmployeeModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var employeeId = button.data('id');
        var modal = $(this);

        // Fetch employee data
        $.ajax({
            url: 'get_employees.php',
            method: 'POST',
            data: { employee_id: employeeId },
            dataType: 'json',
            success: function(data) {
                modal.find('#editEmployeeId').val(data.employee_id);
                modal.find('#editEmployeeName').val(data.name);
                modal.find('#editEmployeePosition').val(data.position);
                modal.find('#editEmployeeDepartment').val(data.department);
                modal.find('#editEmployeeEmail').val(data.email);
                modal.find('#editEmployeeContact').val(data.contact_number);
                modal.find('#editEmployeeStatus').val(data.status);
                modal.find('#editEmployeeUsertype').val(data.status);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + " - " + error);
            }
        });
    });
});