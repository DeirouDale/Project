<?php
    session_start();

	include("../Log in/connection.php");
	include("../Log in/functions.php");

    $user_data = check_login($con);

    if(isset($_POST['submit_btn'])){


        $select_position = mysqli_query($con, "SELECT * FROM `position`");

        if(mysqli_num_rows($select_position) > 0){
            while($fetch_position = mysqli_fetch_assoc($select_position)){
                $pid[] = $fetch_position['id'];
            
            }
        }

        $pid_length = count($pid);


        for ($i = 0; $i < $pid_length; $i++) {
            $name = $pid[$i];
            $value = $_POST[$name];
            echo "Input $i: " . $value . "<br>";
          }


    }
    
   
?>
<!DOCTYPE html>
<html>
<head>
	<title>COE-Voting System</title>
	<link rel="stylesheet" href="style1.css">
</head>
<body>
	<section class= "Navigation">
		<div class="header">
			<nav>
				<img class= "logo-img" src = "../Img/COE.png" width=60px height=60px>
				<span><?php echo $_SESSION['student_number']; ?></span>
			<div class = "btn_log-out">
				<a href="../Log in/logout.php" class = "log-out">Log out</a>
			</div>
			</nav>
		</div>
		<div class="main">	
			<h2>Select Election Title</h2><hr>
            <form method="POST">
                <?php
                    $select_position = mysqli_query($con, "SELECT * FROM `position`");
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
                                        $select_candidate = mysqli_query($con, "SELECT * FROM `candidates` WHERE position_id = '$pid'");

                                        if(mysqli_num_rows($select_candidate) > 0){
                                            while($fetch_candidate = mysqli_fetch_assoc($select_candidate)){ ?>

                                                <div class="candidate">
                                                    <img src="../Img/user.png">
                                                    <ul class = "info">
                                                        <li><b>Name:</b> <?php echo $fetch_candidate['first_name'] . " " . $fetch_candidate['last_name'];?></li>
                                                        <li><b>Course:</b><?php echo $fetch_candidate['course'];?></li>
                                                        <li><b>Year:</b> Third-Year</li>
                                                        <div class="button">
                                                            <button class= "Platform" type= "button">Platform</button>
                                                            <div class="radio-container">
                                                                <input type="radio" name="<?php echo $pid; ?>" value="<?php echo $fetch_candidate['id']; ?>">
                                                                <div class="radio-title">
                                                                    <label>VOTE</label>
                                                                </div>
                                                            </div>
                                                        </div>	
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
                    }
                ?>
                <div class="submit-btn">
                    <button type="submit" name="submit_btn"> Submit </button>
                </div>
            </form>
		</div>	
	</section>
</body>
</html>