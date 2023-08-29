<?php include '../connection.php';?>

<?php
// MySQL database conn configuration
$host = "localhost";
$user = "root";
$password = "";
$database = "voting_system";

// Establish database conn
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
  die("Failed to connect to the database: " . mysqli_connect_error());
}

// Check if the button click request is received
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Update the column in the database
  $query = "SELECT * FROM voters"; // Replace "your_table" with the actual table name
  $result = mysqli_query($conn, $query);

  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $randomPassword = generateRandomPassword();
      
      $updateQuery = "UPDATE voters SET password = '$randomPassword' WHERE id = " . $row['id'];
      // Replace "your_table" with the actual table name
      // Assuming you have a primary key column named "id"
      mysqli_query($conn, $updateQuery);
    }
    echo "Passwords updated successfully!";

  } else {
    echo "Failed to fetch rows from the table.";
  }

  mysqli_free_result($result);
}

mysqli_close($conn);

function generateRandomPassword($length = 10) {
  $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  $password = "";
  $charCount = strlen($chars);
  
  for ($i = 0; $i < $length; $i++) {
    $randomIndex = rand(0, $charCount - 1);
    $password .= $chars[$randomIndex];
  }
  
  return $password;
}
?>