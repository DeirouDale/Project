<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Log in to the SGOD Batac Portal.">
    <title>SDO Batac LRMS</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="../Img/icon.png" type="image/icon type">
</head>
<body>
    <div class="container">
        <div class="box">
            <!-- Login Form -->
            <div class="box-login" id="login">
                <div class="top-header">
                    <div class="image">
                        <img class="logo-img" src="../Img/sdologo.png" alt="SGOD Batac Logo">
                    </div>
                    <h3>Log In</h3>
                    <small>Welcome to SGOD Batac Portal!</small>
                </div>
                <?php if (isset($_GET['error'])): ?>
                    <div class="error-message">
                        <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>
                <div class="input">
                    <form method="POST" action="emp_login_process.php">
                        <div class="input_field">
                            <input type="text" class="emp-input" id="studentNum" name="school_id" required>
                            <label for="studentNum">Employee ID</label> 
                        </div>
                        <div class="input_field">
                            <input type="password" class="emp-input" id="studentPass" name="password" required>
                            <label for="studentPass">Password</label> 
                            <div class="eye-area">
                                <div class="eye-box" onclick="myLogPassword()" aria-label="Toggle password visibility">
                                    <i class="fa-regular fa-eye" id="eye"></i>
                                    <i class="fa-regular fa-eye-slash" id="eye-slash"></i>
                                </div>
                            </div>
                        </div>
                        <div class="input_field">
                            <input type="submit" class="submit-input" value="Log-In" name="log_in_btn">
                        </div>
                    </form>
                    <div class="extra-links">
                    <p>Don't have an account? <a href="javascript:void(0);" onclick="toggleForm('register')" class="link">Register</a></p>
                    <p><a href="javascript:void(0);" onclick="toggleForm('forgotPassword')" class="link">Forgot your password?</a></p>
                </div>

                </div>
            </div>

            <!-- Register Form -->
            <div class="box-register" id="register" style="display:none;">
                <div class="top-header">
                    <div class="image">
                        <img class="logo-img" src="../Img/sdologo.png" alt="SGOD Batac Logo">
                    </div>
                    <h3>Register</h3>
                    <small>Join the SGOD Batac Portal!</small>
                </div>
                <div class="input">
                    <form method="POST" action="emp_register_process.php">
                        <div class="input_field">
                            <input type="text" class="emp-input" id="regName" name="name" required>
                            <label for="name">Name</label> 
                        </div>
                        <div class="input_field">
                            <input type="text" class="emp-input" id="regSchoolId" name="school_id" required>
                            <label for="regSchoolId">Employee ID</label> 
                        </div>
                        <div class="input_field">
                            <input type="password" class="emp-input" id="regPassword" name="password" required>
                            <label for="regPassword">Password</label> 
                        </div>
                        <div class="input_field">
                            <input type="password" class="emp-input" id="confirmPassword" name="confirm_password" required>
                            <label for="confirmPassword">Confirm Password</label>
                        </div>
                        <div class="input_field">
                            <input type="submit" class="submit-input" value="Register" name="register_btn">
                        </div>
                    </form>
                    <div class="extra-links">
                    <p>Already have an account?<a href="javascript:void(0);" onclick="toggleForm('login')" class="link">Log In</a></p>
                </div>
                </div>
            </div>

            <!-- Forgot Password Form -->
            <div class="box-forgot-password" id="forgot-password" style="display:none;">
                <div class="top-header">
                    <div class="image">
                        <img class="logo-img" src="../Img/sdologo.png" alt="SGOD Batac Logo">
                    </div>
                    <h3>Forgot Password</h3>
                    <small>Reset your SGOD Batac Portal password.</small>
                </div>
                <div class="input">
                    <form method="POST" action="emp_forgot_password_process.php">
                        <div class="input_field">
                            <input type="text" class="emp-input" id="forgotEmailOrId" name="email_or_school_id" required>
                            <label for="forgotEmailOrId">Email or School ID</label> 
                        </div>
                        <div class="input_field">
                            <input type="submit" class="submit-input" value="Reset Password" name="reset_password_btn">
                        </div>
                    </form>
                    <div class="extra-links">
                    <a href="javascript:void(0);" onclick="toggleForm('login')" class="link">Back to Log In</a>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myLogPassword() {
            let pass = document.getElementById('studentPass');
            let eye = document.getElementById('eye');
            let eye_S = document.getElementById('eye-slash');

            if (pass.type === "password") {
                pass.type = "text";
                eye.style.opacity = "0";
                eye_S.style.opacity = "1";
            } else {    
                pass.type = "password";
                eye.style.opacity = "1";
                eye_S.style.opacity = "0";
            }
        }

        function toggleForm(formType) {
    const forms = {
        login: document.getElementById('login'),
        register: document.getElementById('register'),
        forgotPassword: document.getElementById('forgot-password')
    };

    for (let key in forms) {
        forms[key].style.display = (key === formType) ? "block" : "none";
    }
}

    </script>
</body>
</html>
