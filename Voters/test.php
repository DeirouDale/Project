<?php
    session_start();

    include("../connection.php");
    include("../Log in/functions.php");

    $user_data = check_login($conn);

    $select_election_title = mysqli_query($conn, "SELECT * FROM `election_title`");
    $fetch_election_title = mysqli_fetch_assoc($select_election_title);
    $election_title = $fetch_election_title['title'];
    $label = $_SESSION['year_level'];

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

    if(isset($_POST['confirm_btn'])){


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
        <section class='confirm-container'>
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
                        <span><b><?php echo $pname[$i]; ?>: </b></span><span>&nbsp<?php echo $cname; ?></span><br>
                    </div>
                    

                <?php
                }
                $select_position = mysqli_query($conn, "SELECT * FROM position WHERE label = '$label'");

                if(mysqli_num_rows($select_position) > 0){
                    $fetch_position = mysqli_fetch_assoc($select_position);
                    $pid = $fetch_position['id'];
                    $pname = $fetch_position['columnName'];
                    $rname = $fetch_position['position'];
                } 
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
                        <span><b><?php echo $pname; ?>: </b></span><span>&nbsp<?php echo $cname; ?></span><br>
                    </div>
                
                    <div class="submit-btn">
                        <button type="submit" name="submit_btn"> Submit </button>
                    </div>
                    <div class = "reset-btn">
                        <a href="index.php" class = "index">Reset</a>
                    </div>
                </form>
            </div>
        </section>
    <?php
    echo "<script>document.querySelector('.confirm-container').style.display = 'flex';</script>";      
    }
    
   
?>
<!DOCTYPE html>
<html>
<head>
	<title>COE-Voting System</title>
	<link rel="stylesheet" href="style1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
	<section class= "Navigation">
		<div class="header">
			<nav>
				<img class= "logo-img" src = "../Img/COE.png" width=60px height=60px>
				<span><?php echo $label; ?></span>
			<div class = "btn_log-out">
				<a href="../Log in/logout.php" class = "log-out">Log out</a>
			</div>
			</nav>
		</div>
		<div class="main">
            <form method="POST">	
			<h2><?php echo $election_title; ?></h2><hr>
                <?php
                    $select_position = mysqli_query($conn, "SELECT * FROM `position` WHERE label = 'General' ");
                    if(mysqli_num_rows($select_position) > 0){
                        while($fetch_position = mysqli_fetch_assoc($select_position)){ 
                            $pid = $fetch_position['id'];
                            ?>
                            
                            <div class="container">
                                <div class="position">
                                    <h3><?php echo $fetch_position['position']; ?></h3>
                                </div>
                                <div class="contents">
                                    <?php
                                        $select_candidate = mysqli_query($conn, "SELECT * FROM `candidates` WHERE position_id = '$pid'");

                                        if(mysqli_num_rows($select_candidate) > 0){
                                            while($fetch_candidate = mysqli_fetch_assoc($select_candidate)){ ?>

                                                <div class="candidate">
                                                    <img src="../Candidate/<?php echo $fetch_candidate['profile'];?>">
                                                    <ul class = "info">
                                                <li><b>Name: </b> <?php echo $fetch_candidate['first_name'] . " " . $fetch_candidate['last_name'];?></li>
                                                <li><b>Course: </b><?php echo $fetch_candidate['course'];?></li>
                                                <li><b>Tagline: </b><?php echo $fetch_candidate['platform'];?></li>
                                            </ul>
                                                </div>
                                            <?php
                                            }
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                        <?php            
                        }  
                    } ?>
                    <?php
                    $select_position = mysqli_query($conn, "SELECT * FROM `position` WHERE label = '$label' ");
                    if(mysqli_num_rows($select_position) > 0){
                        $fetch_position = mysqli_fetch_assoc($select_position);
                        $pid = $fetch_position['id'];
                        ?>
                    
                        <div class="container">
                                <div class="position">
                                        <h3><?php echo $fetch_position['position'];; ?></h3>
                                </div>
                            <div class="contents">
                                <?php
                                $select_candidate = mysqli_query($conn, "SELECT * FROM `candidates` WHERE position_id = '$pid'");

                                if(mysqli_num_rows($select_candidate) > 0){
                                    while($fetch_candidate = mysqli_fetch_assoc($select_candidate)){ ?>

                                        <div class="candidate">
                                            <img src="../Candidate/<?php echo $fetch_candidate['profile'];?>">
                                            <ul class = "info">
                                                <li><b>Name: </b> <?php echo $fetch_candidate['first_name'] . " " . $fetch_candidate['last_name'];?></li>
                                                <li><b>Course: </b><?php echo $fetch_candidate['course'];?></li>
                                                <li><b>Tagline: </b><?php echo $fetch_candidate['platform'];?></li>
                                            </ul>
                                        </div>
                                    <?php
                                    }
                                }
                            ?>
                                
                            </div>
                        </div> 
                    <?php
                    }
                    ?>
                    
                <div class="confirm-btn">
                    <button type="submit" name="confirm_btn"> Submit </button>
                </div>
            </form>
		</div>
        <div class = "pop-up">
            <div class= "close-btn">&times;</div>
            <div class= "form">
            </div>
        </div>	
	</section>
    <script src= "script.js"></script>
</body>
</html>