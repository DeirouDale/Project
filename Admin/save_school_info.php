<?php
include("../connection.php");

// Check if POST data is available
if (isset($_POST['field']) && isset($_POST['value']) && isset($_POST['school_id'])) {
    $field = mysqli_real_escape_string($conn, $_POST['field']);
    $value = mysqli_real_escape_string($conn, $_POST['value']);
    $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);

    // Define allowed fields for security
    $allowed_fields = [
        'previous_name', 'school_id', 'type', 'date_established', 'region',
        'division', 'school_district', 'legislative_district', 'school_head',
        'address', 'telephone_number', 'mobile_number', 'fax_number',
        'website', 'e-mail', 'central_school', 'sped_center', 'with_sped',
        'annex', 'kindergarten', 'grades'
    ];

    if (in_array($field, $allowed_fields)) {
        // Handle boolean fields
        if (in_array($field, ['central_school', 'sped_center', 'with_sped', 'annex', 'kindergarten', 'grades'])) {
            $value = ($value === 'Yes') ? 1 : 0;
        }

        // Prepare and execute the update query
        $query = "UPDATE schools SET $field = '$value' WHERE school_id = '$school_id'";
        if (mysqli_query($conn, $query)) {
            echo 'Success';
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    } else {
        echo 'Invalid field';
    }
} else {
    echo 'Required parameters are missing';
}

// Close the database connection
mysqli_close($conn);
?>
