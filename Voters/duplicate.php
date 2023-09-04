<?php include ("../connection.php");?>
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
			<div class = "btn_log-out">
				<a href="../User/logout.php" class = "log-out">Log out</a>
			</div>
			</nav>
		</div>
		<div class="main">	
			<h2>Thank you for Voting!</h2><hr>
		</div>
		<div class="main">
            <form method="POST">	
			<h2>COE SC Election Candidates</h2><hr>
                <?php
                    $select_position = mysqli_query($conn, "SELECT * FROM `position`");
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
                   
                                
                            </div>
                        </div> 
	</section>
<script src= "script.js"></script>
</body>
</html>s