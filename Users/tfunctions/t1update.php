<?php
// update_table.php
include('../../connection.php');

// Retrieve the POST data
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'No data received.']);
    exit;
}

// Extract the table ID and other data
$tableId = intval($data['tableId']);
$mepmuslimkindergartenmale = mysqli_real_escape_string($conn, $data['upmepmuslimkindergartenmale']);
$mepmuslimkindergartenfemale = mysqli_real_escape_string($conn, $data['upmepmuslimkindergartenfemale']);
$mepmuslimgrade1male = mysqli_real_escape_string($conn, $data['upmepmuslimgrade1male']);
$mepmuslimgrade1female = mysqli_real_escape_string($conn, $data['upmepmuslimgrade1female']);
$mepmuslimgrade2male = mysqli_real_escape_string($conn, $data['upmepmuslimgrade2male']);
$mepmuslimgrade2female = mysqli_real_escape_string($conn, $data['upmepmuslimgrade2female']);
$mepmuslimgrade3male = mysqli_real_escape_string($conn, $data['upmepmuslimgrade3male']);
$mepmuslimgrade3female = mysqli_real_escape_string($conn, $data['upmepmuslimgrade3female']);
$mepmuslimgrade4male = mysqli_real_escape_string($conn, $data['upmepmuslimgrade4male']);
$mepmuslimgrade4female = mysqli_real_escape_string($conn, $data['upmepmuslimgrade4female']);
$mepmuslimgrade5male = mysqli_real_escape_string($conn, $data['upmepmuslimgrade5male']);
$mepmuslimgrade5female = mysqli_real_escape_string($conn, $data['upmepmuslimgrade5female']);
$mepmuslimgrade6male = mysqli_real_escape_string($conn, $data['upmepmuslimgrade6male']);
$mepmuslimgrade6female = mysqli_real_escape_string($conn, $data['upmepmuslimgrade6female']);
$total_mepmuslimmale = mysqli_real_escape_string($conn, $data['uptotal_mepmuslimmale']);
$total_mepmuslimfemale = mysqli_real_escape_string($conn, $data['uptotal_mepmuslimfemale']);
$mepnonmuslimkindergartenmale = mysqli_real_escape_string($conn, $data['upmepnonmuslimkindergartenmale']);
$mepnonmuslimkindergartenfemale = mysqli_real_escape_string($conn, $data['upmepnonmuslimkindergartenfemale']);
$mepnonmuslimgrade1male = mysqli_real_escape_string($conn, $data['upmepnonmuslimgrade1male']);
$mepnonmuslimgrade1female = mysqli_real_escape_string($conn, $data['upmepnonmuslimgrade1female']);
$mepnonmuslimgrade2male = mysqli_real_escape_string($conn, $data['upmepnonmuslimgrade2male']);
$mepnonmuslimgrade2female = mysqli_real_escape_string($conn, $data['upmepnonmuslimgrade2female']);
$mepnonmuslimgrade3male = mysqli_real_escape_string($conn, $data['upmepnonmuslimgrade3male']);
$mepnonmuslimgrade3female = mysqli_real_escape_string($conn, $data['upmepnonmuslimgrade3female']);
$mepnonmuslimgrade4male = mysqli_real_escape_string($conn, $data['upmepnonmuslimgrade4male']);
$mepnonmuslimgrade4female = mysqli_real_escape_string($conn, $data['upmepnonmuslimgrade4female']);
$mepnonmuslimgrade5male = mysqli_real_escape_string($conn, $data['upmepnonmuslimgrade5male']);
$mepnonmuslimgrade5female = mysqli_real_escape_string($conn, $data['upmepnonmuslimgrade5female']);
$mepnonmuslimgrade6male = mysqli_real_escape_string($conn, $data['upmepnonmuslimgrade6male']);
$mepnonmuslimgrade6female = mysqli_real_escape_string($conn, $data['upmepnonmuslimgrade6female']);
$total_mepnonmuslimmale = mysqli_real_escape_string($conn, $data['uptotal_mepnonmuslimmale']);
$total_mepnonmuslimfemale = mysqli_real_escape_string($conn, $data['uptotal_mepnonmuslimfemale']);
$ssesgrade1male = mysqli_real_escape_string($conn, $data['upssesgrade1male']);
$ssesgrade1female = mysqli_real_escape_string($conn, $data['upssesgrade1female']);
$ssesgrade2male = mysqli_real_escape_string($conn, $data['upssesgrade2male']);
$ssesgrade2female = mysqli_real_escape_string($conn, $data['upssesgrade2female']);
$ssesgrade3male = mysqli_real_escape_string($conn, $data['upssesgrade3male']);
$ssesgrade3female = mysqli_real_escape_string($conn, $data['upssesgrade3female']);
$ssesgrade4male = mysqli_real_escape_string($conn, $data['upssesgrade4male']);
$ssesgrade4female = mysqli_real_escape_string($conn, $data['upssesgrade4female']);
$ssesgrade5male = mysqli_real_escape_string($conn, $data['upssesgrade5male']);
$ssesgrade5female = mysqli_real_escape_string($conn, $data['upssesgrade5female']);
$ssesgrade6male = mysqli_real_escape_string($conn, $data['upssesgrade6male']);
$ssesgrade6female = mysqli_real_escape_string($conn, $data['upssesgrade6female']);
$total_ssesmale = mysqli_real_escape_string($conn, $data['uptotal_ssesmale']);
$total_ssesfemale = mysqli_real_escape_string($conn, $data['uptotal_ssesfemale']);

// Construct the SQL query to update the table
$query = "UPDATE learners_by_program SET 
    mepmuslimkindergartenmale = '$mepmuslimkindergartenmale',
    mepmuslimkindergartenfemale = '$mepmuslimkindergartenfemale',
    mepmuslimgrade1male = '$mepmuslimgrade1male',
    mepmuslimgrade1female = '$mepmuslimgrade1female',
    mepmuslimgrade2male = '$mepmuslimgrade2male',
    mepmuslimgrade2female = '$mepmuslimgrade2female',
    mepmuslimgrade3male = '$mepmuslimgrade3male',
    mepmuslimgrade3female = '$mepmuslimgrade3female',
    mepmuslimgrade4male = '$mepmuslimgrade4male',
    mepmuslimgrade4female = '$mepmuslimgrade4female',
    mepmuslimgrade5male = '$mepmuslimgrade5male',
    mepmuslimgrade5female = '$mepmuslimgrade5female',
    mepmuslimgrade6male = '$mepmuslimgrade6male',
    mepmuslimgrade6female = '$mepmuslimgrade6female',
    total_mepmuslimmale = '$total_mepmuslimmale',
    total_mepmuslimfemale = '$total_mepmuslimfemale',
    mepnonmuslimkindergartenmale = '$mepnonmuslimkindergartenmale',
    mepnonmuslimkindergartenfemale = '$mepnonmuslimkindergartenfemale',
    mepnonmuslimgrade1male = '$mepnonmuslimgrade1male',
    mepnonmuslimgrade1female = '$mepnonmuslimgrade1female',
    mepnonmuslimgrade2male = '$mepnonmuslimgrade2male',
    mepnonmuslimgrade2female = '$mepnonmuslimgrade2female',
    mepnonmuslimgrade3male = '$mepnonmuslimgrade3male',
    mepnonmuslimgrade3female = '$mepnonmuslimgrade3female',
    mepnonmuslimgrade4male = '$mepnonmuslimgrade4male',
    mepnonmuslimgrade4female = '$mepnonmuslimgrade4female',
    mepnonmuslimgrade5male = '$mepnonmuslimgrade5male',
    mepnonmuslimgrade5female = '$mepnonmuslimgrade5female',
    mepnonmuslimgrade6male = '$mepnonmuslimgrade6male',
    mepnonmuslimgrade6female = '$mepnonmuslimgrade6female',
    total_mepnonmuslimmale = '$total_mepnonmuslimmale',
    total_mepnonmuslimfemale = '$total_mepnonmuslimfemale',
    ssesgrade1male = '$ssesgrade1male',
    ssesgrade1female = '$ssesgrade1female',
    ssesgrade2male = '$ssesgrade2male',
    ssesgrade2female = '$ssesgrade2female',
    ssesgrade3male = '$ssesgrade3male',
    ssesgrade3female = '$ssesgrade3female',
    ssesgrade4male = '$ssesgrade4male',
    ssesgrade4female = '$ssesgrade4female',
    ssesgrade5male = '$ssesgrade5male',
    ssesgrade5female = '$ssesgrade5female',
    ssesgrade6male = '$ssesgrade6male',
    ssesgrade6female = '$ssesgrade6female',
    total_ssesmale = '$total_ssesmale',
    total_ssesfemale = '$total_ssesfemale'
    WHERE id = $tableId";

// Execute the query
if (mysqli_query($conn, $query)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating record: ' . mysqli_error($conn)]);
}

// Close the database connection
mysqli_close($conn);
?>
