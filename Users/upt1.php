<?php
include('../connection.php');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['data'])) {
    $dataArray = $data['data'];

    foreach ($dataArray as $index => $rowData) {
        // Assuming the table structure and identifiers
        $query = "UPDATE learners_by_program SET
            mep_muslim_kindergarten_male = ?,
            mep_muslim_kindergarten_female = ?,
            mep_muslim_grade1_male = ?,
            mep_muslim_grade1_female = ?,
            mep_muslim_grade2_male = ?,
            mep_muslim_grade2_female = ?,
            mep_muslim_grade3_male = ?,
            mep_muslim_grade3_female = ?,
            mep_muslim_grade4_male = ?,
            mep_muslim_grade4_female = ?,
            mep_muslim_grade5_male = ?,
            mep_muslim_grade5_female = ?,
            mep_muslim_grade6_male = ?,
            mep_muslim_grade6_female = ?,
            mep_muslim_total_male = ?,
            mep_muslim_total_female = ?,
            mep_non_muslim_kindergarten_male = ?,
            mep_non_muslim_kindergarten_female = ?,
            mep_non_muslim_grade1_male = ?,
            mep_non_muslim_grade1_female = ?,
            mep_non_muslim_grade2_male = ?,
            mep_non_muslim_grade2_female = ?,
            mep_non_muslim_grade3_male = ?,
            mep_non_muslim_grade3_female = ?,
            mep_non_muslim_grade4_male = ?,
            mep_non_muslim_grade4_female = ?,
            mep_non_muslim_grade5_male = ?,
            mep_non_muslim_grade5_female = ?,
            mep_non_muslim_grade6_male = ?,
            mep_non_muslim_grade6_female = ?,
            mep_non_muslim_total_male = ?,
            mep_non_muslim_total_female = ?,
            sses_grade1_male = ?,
            sses_grade1_female = ?,
            sses_grade2_male = ?,
            sses_grade2_female = ?,
            sses_grade3_male = ?,
            sses_grade3_female = ?,
            sses_grade4_male = ?,
            sses_grade4_female = ?,
            sses_grade5_male = ?,
            sses_grade5_female = ?,
            sses_grade6_male = ?,
            sses_grade6_female = ?,
            sses_total_male = ?,
            sses_total_female = ?
            WHERE id = ?";

        // Prepare and execute the SQL statement
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            echo json_encode(['success' => false, 'message' => $conn->error]);
            exit();
        }

        // Bind parameters
        $stmt->bind_param('ssssssssssssssssssssssssssssss', 
            $rowData[0], $rowData[1], $rowData[2], $rowData[3], 
            $rowData[4], $rowData[5], $rowData[6], $rowData[7],
            $rowData[8], $rowData[9], $rowData[10], $rowData[11],
            $rowData[12], $rowData[13], $rowData[14], $rowData[15],
            $rowData[16], $rowData[17], $rowData[18], $rowData[19],
            $rowData[20], $rowData[21], $rowData[22], $rowData[23],
            $rowData[24], $rowData[25], $rowData[26], $rowData[27],
            $rowData[28], $rowData[29], $rowData[30], $rowData[31],
            $rowData[32]
        );

        $stmt->execute();
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'No data received']);
}

$conn->close();
?>
