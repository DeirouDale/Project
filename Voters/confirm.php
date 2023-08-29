<?php
 session_start();

 include("../connection.php");
 include("../Log in/functions.php");

 $user_data = check_login($conn);

 $select_election_title = mysqli_query($conn, "SELECT * FROM `election_title`");
 $fetch_election_title = mysqli_fetch_assoc($select_election_title);
 $election_title = $fetch_election_title['title'];

 $label = $_SESSION['year_level'];
 $student_number = $_SESSION['student_number'];

 $select_logo = mysqli_query($conn, "SELECT * FROM `voters` WHERE student_number = '$student_number'");
 $fetch_logo = mysqli_fetch_assoc($select_logo);
 $course = $fetch_logo['course'];

 if($course == 'BS in Agricultural and Biosystems Engineering'){
     $logo = "../Img/2.png";
 }
 else if($course == 'BS in Ceramics Engineering'){
     $logo = "../Img/9.png";
 }
 else if($course == 'BS in Chemical Engineering'){
     $logo = "../Img/7.png";
 }
 else if($course == 'BS in Civil Engineering'){
     $logo = "../Img/8.png";
 }
 else if($course == 'BS in Computer Engineering'){
     $logo = "../Img/6.png";
 }
 else if($course == 'BS in Electrical Engineering'){
     $logo = "../Img/1.png";
 }
 else if($course == 'BS in Electronics Engineering'){
     $logo = "../Img/4.png";
 }
 else if($course == 'BS in Mechanical Engineering'){
     $logo = "../Img/3.png";
 }
 else{
     $logo = "none";
 }

 if(isset($_POST['submit_btn'])){


    $select_position = mysqli_query($conn, "SELECT * FROM position");

    if(mysqli_num_rows($select_position) > 0){
        while($fetch_position = mysqli_fetch_assoc($select_position)){
            $pid[] = $fetch_position['id'];
            $pname[] = $fetch_position['columnName'];
        }
    }

    $pid_length = count($pid);


    for ($i = 0; $i < $pid_length; $i++) {
        $colname = $pname[$i];
        
        $votes = $_POST[$colname] ?? 0;
        
        $votes_array[] = $votes;
      }
    
    $votes_compiled = implode(', ', $votes_array );
    
    $position_names = implode(', ', $pname);

    $student_number = $_SESSION['student_number'];
    $col_student_number = preg_replace('/-/', '', $student_number);
    $insert_votes = mysqli_query($conn, "INSERT INTO votes (student_number, $position_names) VALUES($col_student_number, $votes_compiled)");
    $update_state = mysqli_query($conn, "UPDATE `voters` SET voted='Yes' WHERE student_number='$student_number'");
    
    if($insert_votes && $update_state){
        header("location:duplicate.php");
    }
    else{
        header("location:index.php");
    }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
	<title>COE-Voting System</title>
	<link rel="stylesheet" href="style1.css">
     <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
	<section class= "Navigation">
		<div class="header">
			<nav>
				<img class= "logo-img" src = "../Img/COE.png" width=60px height=60px>
                <img class= "logo-img" src = "<?php echo $logo;?>" width=60px height=60px>
				<span><?php echo $student_number; ?></span>
			</nav>
		</div>
		<div class="main">
            <?php
            $select_position = mysqli_query($conn, "SELECT * FROM position WHERE label = 'General'");

            if(mysqli_num_rows($select_position) > 0){
                while($fetch_position = mysqli_fetch_assoc($select_position)){
                    $pid[] = $fetch_position['id'];
                    $pname[] = $fetch_position['columnName'];
                    $rname[] = $fetch_position['position'];
                }
            }
    
            $pid_length = count($pid); 
            ?>
            <div class='confirm-container'>
                <div class="confirm-form">
                    <h2>Summary</h2>
                    <form method="POST">
                    
                    <?php
                    for ($i = 0; $i < $pid_length; $i++) {
                        $name = $pid[$i];
                        
                        $votes = $_POST[$name] ?? 0;
                        
                        $votes_array[] = $votes;
    
                        $cname = "";
    
                        if ($votes >= 1){
                            $select_posname = mysqli_query($conn, "SELECT * FROM candidates WHERE id = '$votes'");
                            $fetch_posname = mysqli_fetch_assoc($select_posname);
                            $fname = $fetch_posname['first_name'];
                            $lname = $fetch_posname['last_name'];
                            $cname = "$fname $lname";
                        }
                        else{
                            $cname = "none";
                        }?>
                        
                        
                        <div class='form'>
                            <input type='hidden' name='<?php echo $pname[$i]; ?>' value='<?php echo $votes; ?>'>
                            <span><b><?php echo $rname[$i]; ?>: </b></span><span>&nbsp<?php echo $cname; ?></span><br>
                        </div>
                        
    
                    <?php
                    }
                    $select_position = mysqli_query($conn, "SELECT * FROM position WHERE label = '$label'");
    
                    if(mysqli_num_rows($select_position) > 0){
                        $fetch_position = mysqli_fetch_assoc($select_position);
                        $pid = $fetch_position['id'];
                        $pname = $fetch_position['columnName'];
                        $rname = $fetch_position['position'];
                        $votes = $_POST[$pid] ?? 0;
                        
                        $cname = "";
    
                        if ($votes >= 1){
                            $select_posname = mysqli_query($conn, "SELECT * FROM candidates WHERE id = '$votes'");
                            $fetch_posname = mysqli_fetch_assoc($select_posname);
                            $fname = $fetch_posname['first_name'];
                            $lname = $fetch_posname['last_name'];
                            $cname = "$fname $lname";
                        }
                        else{
                            $cname = "none";
                        }?>
    
                        <div class='form'>
                            <input type='hidden' name='<?php echo $pname; ?>' value='<?php echo $votes; ?>'>
                            <span><b><?php echo $rname; ?>: </b></span><span>&nbsp<?php echo $cname; ?></span><br>
                        </div>
                    <?php
                    } ?>
                        
                    <div class="action-btn">
                        <div class="submit-btn">
                            <button type="submit" name="submit_btn"> Submit </button>
                        </div>
                        <div class = "reset-btn">
                            <a href="index.php" class = "index">Reset</a>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
	</section>
</body>
</html>