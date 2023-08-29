<?php include '../connection.php';?>    
<?php
// get_users.php

// Database connection

// Check if the 'course' parameter is set
if (isset($_GET['course'])) {
    $courseFilter = $_GET['course'];

    // Prepare the query
    if ($courseFilter === 'all') {
        $query = "SELECT * FROM voters";
    } else {
        $query = "SELECT * FROM voters WHERE course = '$courseFilter'";
    }

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Generate the HTML for table rows
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            echo "<tr>";
            echo "<td>{$row['student_number']}</td>";
            echo "<td>{$row['first_name']}</td>";
            echo "<td>{$row['last_name']}</td>";
            echo "<td>{$row['course']}</td>";
            echo "<td>{$row['year_level']}</td>";
            echo "<td>{$row['password']}</td>";
            echo "<td>{$row['voted']}</td>";?>
            <td>
                                <?php
                                echo '<button id="pop-upButton' . $id . '" data-bookId="' . $id . '" class="update_vote" onclick="return confirm(\'Are you sure you want to update this vote?\')">UPDATE</button>';
                            ?>

                                <a href="voters_delete.php?id=<?php echo $id; ?>" id="<?php echo $id; ?>" class="btn_addCandidates-2" onclick="return confirm('Are you sure you want to delete this position?')">Delete</a>

                            </td>

<?php
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No voters found.</td></tr>";
    }
}

// Close the database connection
mysqli_close($conn);
?>
