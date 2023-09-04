<?php
    session_start();

    include("../connection.php");
    include("../User/functions.php");

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
			<div class = "btn_log-out">
				<a href="../User/logout.php" class = "log-out">Log out</a>
			</div>
			</nav>
		</div>
		<div class="main">
            <form method="POST" action="confirm.php">	
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
                                                    <div class="info-con">
                                                    <ul class = "info">
                                                        <li><b>Name:</b> <?php echo $fetch_candidate['first_name'] . " " . $fetch_candidate['last_name'];?></li>
                                                        <li><b>Course:&nbsp</b><?php echo $fetch_candidate['course'];?></li>
                                                        <li class = "tagline"><b>Tagline:&nbsp</b><?php echo $fetch_candidate['platform'];?></li>
                                                    </ul>
                                                    <div class = "button-vote">
                                                        <div class="radio-container">
                                                            <input type="radio" name="<?php echo $pid; ?>" value="<?php echo $fetch_candidate['id']; ?>">
                                                            <div class="radio-title">
                                                                    <label>Vote</label>
                                                             </div>
                                                        </div>
                                                    </div>
                                                    </div> 
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
                                            <div class = "info-con">
                                                <ul class = "info">
                                                    <li><b>Name:</b> <?php echo $fetch_candidate['first_name'] . " " . $fetch_candidate['last_name'];?></li>
                                                    <li><b>Course:&nbsp</b><?php echo $fetch_candidate['course'];?></li>
                                                    <li><b>Tagline:&nbsp</b><?php echo $fetch_candidate['platform'];?></li>
                                                </ul>
                                                    <div class = "button-vote">
                                                        <div class="radio-container">
                                                            <input type="radio" name="<?php echo $pid; ?>" value="<?php echo $fetch_candidate['id']; ?>">
                                                            <div class="radio-title">
                                                                <label>Vote</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>  
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