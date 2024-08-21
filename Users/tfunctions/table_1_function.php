<?php
include('../../connection.php');

// Get the JSON data sent from JavaScript
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    // Extract the selected date
    $selectedDate = $data['date'];

    // Prepare SQL update queries
    $query = "INSERT INTO learners_by_program (date, mepmuslimkindergartenmale, mepmuslimkindergartenfemale, 
    mepmuslimgrade1male, mepmuslimgrade1female, mepmuslimgrade2male, mepmuslimgrade2female, mepmuslimgrade3male, 
    mepmuslimgrade3female, mepmuslimgrade4male, mepmuslimgrade4female, mepmuslimgrade5male, mepmuslimgrade5female, 
    mepmuslimgrade6male, mepmuslimgrade6female, total_mepmuslimmale, total_mepmuslimfemale, mepnonmuslimkindergartenmale, 
    mepnonmuslimkindergartenfemale, mepnonmuslimgrade1male, mepnonmuslimgrade1female, mepnonmuslimgrade2male, 
    mepnonmuslimgrade2female, mepnonmuslimgrade3male, mepnonmuslimgrade3female, mepnonmuslimgrade4male, mepnonmuslimgrade4female, 
    mepnonmuslimgrade5male, mepnonmuslimgrade5female, mepnonmuslimgrade6male, mepnonmuslimgrade6female, total_mepnonmuslimmale, 
    total_mepnonmuslimfemale, ssesgrade1male, ssesgrade1female, ssesgrade2male, ssesgrade2female, ssesgrade3male, ssesgrade3female, 
    ssesgrade4male, ssesgrade4female, ssesgrade5male, ssesgrade5female, ssesgrade6male, ssesgrade6female, total_ssesmale, 
    total_ssesfemale) VALUES ('$selectedDate', '" . $data['mepmuslimkindergartenmale'] . "', '" . $data['mepmuslimkindergartenfemale'] . "', 
    '" . $data['mepmuslimgrade1male'] . "', '" . $data['mepmuslimgrade1female'] . "', '" . $data['mepmuslimgrade2male'] . "', 
    '" . $data['mepmuslimgrade2female'] . "', '" . $data['mepmuslimgrade3male'] . "', '" . $data['mepmuslimgrade3female'] . "', 
    '" . $data['mepmuslimgrade4male'] . "', '" . $data['mepmuslimgrade4female'] . "', '" . $data['mepmuslimgrade5male'] . "', 
    '" . $data['mepmuslimgrade5female'] . "', '" . $data['mepmuslimgrade6male'] . "', '" . $data['mepmuslimgrade6female'] . "', 
    '" . $data['total_mepmuslimmale'] . "', '" . $data['total_mepmuslimfemale'] . "', '" . $data['mepnonmuslimkindergartenmale'] . "', 
    '" . $data['mepnonmuslimkindergartenfemale'] . "', '" . $data['mepnonmuslimgrade1male'] . "', '" . $data['mepnonmuslimgrade1female'] . "', 
    '" . $data['mepnonmuslimgrade2male'] . "', '" . $data['mepnonmuslimgrade2female'] . "', '" . $data['mepnonmuslimgrade3male'] . "', 
    '" . $data['mepnonmuslimgrade3female'] . "', '" . $data['mepnonmuslimgrade4male'] . "', '" . $data['mepnonmuslimgrade4female'] . "', 
    '" . $data['mepnonmuslimgrade5male'] . "', '" . $data['mepnonmuslimgrade5female'] . "', '" . $data['mepnonmuslimgrade6male'] . "', 
    '" . $data['mepnonmuslimgrade6female'] . "', '" . $data['total_mepnonmuslimmale'] . "', '" . $data['total_mepnonmuslimfemale'] . "', 
    '" . $data['ssesgrade1male'] . "', '" . $data['ssesgrade1female'] . "', '" . $data['ssesgrade2male'] . "', '" . $data['ssesgrade2female'] . "', 
    '" . $data['ssesgrade3male'] . "', '" . $data['ssesgrade3female'] . "', '" . $data['ssesgrade4male'] . "', '" . $data['ssesgrade4female'] . "', 
    '" . $data['ssesgrade5male'] . "', '" . $data['ssesgrade5female'] . "', '" . $data['ssesgrade6male'] . "', '" . $data['ssesgrade6female'] . "', 
    '" . $data['total_ssesmale'] . "', '" . $data['total_ssesfemale'] . "')";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No data received.']);
}
?>
