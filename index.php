<?php
session_start();
$error = "";

if(!empty($_GET['register']) && $_GET['register'] == 'success') {
    $success = "Registration successful! Please login.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<style>
/* General body styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Login box */
.login-container {
    background-color: #ffffff;
    padding: 40px 30px;
    border-radius: 10px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    width: 360px;
    box-sizing: border-box;
}

/* Heading */
h2 {
    text-align: center;
    color: #333333;
    margin-bottom: 30px;
    font-weight: 600;
}

/* Input group */
.input-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 6px;
    color: #666666;
    font-size: 14px;
}

/* Inputs */
input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
    font-size: 14px;
    transition: border 0.3s;
}

input[type="text"]:focus,
input[type="password"]:focus {
    border-color: #4CAF50;
    outline: none;
}

/* Login button */
.login-button {
    width: 100%;
    padding: 14px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: background 0.3s;
}

.login-button:hover {
    background-color: #45a049;
}

/* Messages */
.error {
    color: #e74c3c;
    text-align: center;
    margin-bottom: 15px;
    font-size: 14px;
}

.success {
    color: #27ae60;
    text-align: center;
    margin-bottom: 15px;
    font-size: 14px;
}

/* Register link */
.register-link {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
}

.register-link a {
    color: #4CAF50;
    text-decoration: none;
    font-weight: 500;
}

.register-link a:hover {
    text-decoration: underline;
}

</style>
</head>
<body>
<div class="login-container">
    <h2>Login to Your Account</h2>
    
    <?php if(!empty($success)) echo "<div class='success'>$success</div>"; ?>
    <?php if(!empty($_SESSION['error'])) { echo "<div class='error'>".$_SESSION['error']."</div>"; unset($_SESSION['error']); } ?>
    
    <form action="login.php" method="POST">
        <div class="input-group">
            <label for="ID">ID</label>
            <input type="text" id="ID" name="ID" required>
        </div>
        <div class="input-group">
            <label for="PW">Password</label>
            <input type="password" id="PW" name="PW" required>
        </div>
        <button type="submit" class="login-button">Login</button>
    </form>
    
    <div class="register-link">
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</div>
</body>
</html>
