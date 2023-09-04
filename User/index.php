<?php
session_start();

	include("../connection.php");
	include("functions.php");

	if(isset($_POST['log_in_btn'])){

		$student_num = $_POST['student_num'];
		$password = $_POST['password'];

		if(!empty($student_num) && !empty($password)){

			$query = "SELECT * FROM voters where student_number = '$student_num'";

			$result = mysqli_query($conn, $query);

			if($result){
				if(mysqli_num_rows($result) > 0){

					$user_data = mysqli_fetch_assoc($result);

					if($user_data['password'] == $password){

						$_SESSION['year_level'] = $user_data['year_level'];

						$_SESSION['student_number'] = $user_data['student_number'];

						header("location:../Voters/duplicate_check.php");
						die;
					}
				}
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>COE-Voting-System</title>
	<link rel="stylesheet" href= "../style.css">
	<link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link rel="icon" href="../Img/COE.png" type="image/icon type">
</head>
<body>
	<div class = "container">
		<div class = "box">
			<div class = "box-login" id = "login">
				<div class = "top-header">
					<div class = "image">
						<img class = "logo-img" src="../Img/COE.png">
					</div>
					<h3>Log In</h3>
					<small>Welcome to the E-Voting System!</small>
				</div>
				<div class= "input">

					<form method="POST">
						<div class = "input_field">
							<input type="text" class = "stud-input" id= "studentNum" name="student_num" required>
							<label for= "studentNum">Student Number</label> 
						</div>
						<div class = "input_field">
							<input type="password" class = "stud-input" id= "studentPass" name="password" required>
							<label for= "studentNum">Password</label> 
							<div class = "eye-area">
								<div class = "eye-box" onclick = "myLogPassword()">
									<i class = "fa-regular fa-eye" id= "eye"></i>
									<i class = "fa-regular fa-eye-slash" id= "eye-slash"></i>
								</div>
							</div>
						</div>
						<div class = "input_field">
							<input type="submit" class= "submit-input" value="Log-In" name="log_in_btn">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
		function myLogPassword(){
    		let pass = document.getElementById('studentPass');
    		let eye = document.getElementById('eye');
    		let eye_S = document.getElementById('eye-slash');
    	
    		if(pass.type === "password"){
        		pass.type = "text"
        		eye.style.opacity = "0";
        		eye_S.style.opacity = "1";

    		}else{    
        		pass.type = "password"
        		eye.style.opacity = "1";
        		eye_S.style.opacity = "0";
    		}
   		}
	</script>
</body>
</html>