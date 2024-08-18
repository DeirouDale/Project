<?php
// Retrieve the school_id from the session
$school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : 'Not logged in';

// Optionally check if the user is logged in based on session
if ($school_id === 'Not logged in') {
    header("Location: login.php?error=Please log in first");
    exit();
}
?>