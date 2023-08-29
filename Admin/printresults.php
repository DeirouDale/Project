<?php include '../connection.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="../style3.css">

    <title>COE-Voting-System</title>
</head>

<body>

    <!-- MAIN -->
    <main>
        <div class="top">
            <span class="header">COE SC ELECTION RESULTS</span>
        </div>
        <div class="result-container">
            <?php
            $select_position = mysqli_query($conn, "SELECT * FROM `position`");
            if (mysqli_num_rows($select_position) > 0) {
                while ($fetch_position = mysqli_fetch_assoc($select_position)) {
                    $id = $fetch_position['id'];
                    $position = $fetch_position['position'];
                    ?>
                    <div class="result-position">
                        <h1><?php echo $position; ?></h1>
                    </div>
                    <div class="table-container">
                        <table class="result-table">
                            <tbody>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM `result` WHERE position='$position' ORDER BY t_votes DESC");
                                if (mysqli_num_rows($result) > 0) {
                                    $highest_votes = 0; // Variable to store the highest number of votes
                                    while ($fetch_result = mysqli_fetch_assoc($result)) {
                                        $id = $fetch_result['id'];
                                        $name = $fetch_result['name'];
                                        $t_votes = $fetch_result['t_votes'];
                                        $voters_select = mysqli_query($conn, "SELECT * FROM `voters`");
                                        $voters_quantity = mysqli_num_rows($voters_select);

                                        $img = mysqli_query($conn, "SELECT profile FROM `candidates` WHERE id='$id' ");
                                        $fetch_img = mysqli_fetch_assoc($img);
                                        $img = $fetch_img['profile'];

                                        // Check if the current row has the highest number of votes
                                        if ($t_votes > $highest_votes) {
                                            $highest_votes = $t_votes;
                                            $highest_candidate = $name;
                                        }
                                        ?>
                                        <tr <?php if ($name === $highest_candidate) echo 'class="highlight-row"'; ?>>
                                            <td><?php echo $name; ?></td>
                                            <td style="width: 300px;"><?php echo round($t_votes); ?></td>
                                        </tr>

                                        <tr class="table-line"></tr> <!-- Table line -->
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="2">No candidates found for this position.</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                }
            } else {
                ?>
                <p>No positions found.</p>
                <?php
            }
            ?>
        </div>
    </main>

    <script src="../script.js"></script>
</body>

<style>
    .table-container {
        display: flex;
        background-color: white;
        margin-left: 20px;
        margin-right: 20px;
    }

    .table-container .result-table .header {
        font-size: 20px;
    }

    .table-container .result-table .cont td {
        padding-left: 20px;
    }

    .result-container {
        padding: 30px;
    }

    .result-position {
        text-align: center;
    }

    .result-position h1 {
        font-size: 24px;
        font-weight: bold;
        margin-left: 20px;
    }

    .result-table {
        width: 100%;
        border-collapse: collapse;
    }

    .result-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ccc;
        font-size: px;
        font-weight: bold;
        font-family: montserrat;
    }

    .result-table .table-header {
        font-size: 18px;
        font-weight: bold;
    }

    .table-line {
        height: 1px;
        background-color: #ccc;
    }

    .no-candidates {
        font-style: italic;
        font-size: 16px;
        font-weight: bold;
    }

    .no-positions {
        font-style: italic;
        font-size: 16px;
        font-weight: bold;
    }

    .highlight-row {
        background-color: yellow;
        font-weight: bold;
    }
</style>

</html>
