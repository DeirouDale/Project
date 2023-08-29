<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8">
	<title>COE-Voting-System</title>
	<link rel="stylesheet" href= "style.css">
	<link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link rel="icon" href="C:\Users\acer\Desktop\HTML CSS practice\Project\Img\COE.png" type="image/icon type">
</head>
<body>
	<div class = "container">
		<div class = "box">
			<div class = "box-login" id = "login">
				<div class = "top-header">
					<div class = "image">
						<img class = "logo-img" src="C:\Users\acer\Desktop\HTML CSS practice\Project\Img\COE.png">
					</div>
					<h3>Log In</h3>
					<small>Welcome to the E-Voting System!</small>
				</div>
				<div class= "input">
					<div class = "input_field">
						<input type="text" class = "stud-input" id= "studentNum" required>
						<label for= "studentNum">Username</label> 
					</div>
					<div class = "input_field">
						<input type="password" class = "stud-input" id= "studentPass" required>
						<label for= "studentNum">Password</label> 
						<div class = "eye-area">
							<div class = "eye-box" onclick = "myLogPassword()">
								<i class = "fa-regular fa-eye" id= "eye"></i>
								<i class = "fa-regular fa-eye-slash" id= "eye-slash"></i>
							</div>
						</div>
					</div>
					<div class = "input_field">
						<input type="submit" class= "submit-input" value= "Log-In">
					</div>
					<div class = "lostPassword">
						<a href="#">Lost Password?</a>
				</div>
				<div class = "info">
					<br><br><hr>
					<h3>Is this your first time here?</h3>
					<div class = "inside">
						<p><b>For Student Voters:</b><br></p>
						<dd>To proceed, please use the student credentials which consist of student number and the password that was assigned by the administrator prior to the election.</dd>
					</div>
					<div class = "inside">
						<p><b>For Accessing Admin:</b><br></p>
						<dd>Request the credentials from authorized facilitators</dd><br><br><hr>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		function myLogPassword(){
    		var pass = document.getElementById('studentPass');
    		var eye = document.getElementById('eye');
    		var eye_S = document.getElementById('eye-slash');
    	
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