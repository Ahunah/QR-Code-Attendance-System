<?php
include 'config.php';
session_start();

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $ID = $_POST['ID'] ?? '';
    $USERNAME = $_POST['USERNAME'] ?? '';
    $PW = $_POST['PW'] ?? '';
    
    $stmt = $conn->prepare("SELECT * FROM user WHERE ID=?");
    $stmt->bind_param("s", $ID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $error = "ID already exists!";
    } else {
        $insert = $conn->prepare("INSERT INTO user (ID, USERNAME, PW, STATUS) VALUES (?, ?, ?, 'registered')");
        $insert->bind_param("sss", $ID, $USERNAME, $PW);
        if($insert->execute()){
            header("Location: index.php?register=success");
            exit();
        } else {
            $error = "Registration failed!";
        }
        $insert->close();
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register Page</title>
<style>

body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Registration box */
.register-container {
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

/* Input groups */
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
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    background-color: #e6f0ff; /* light blue for all fields */
}

input[type="text"]:focus,
input[type="password"]:focus {
    border-color: #4CAF50;
    outline: none;
}

/* Register button */
.register-button {
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

.register-button:hover {
    background-color: #45a049;
}

/* Messages */
.error {
    color: #e74c3c;
    text-align: center;
    margin-bottom: 15px;
    font-size: 14px;
}

/* Login link */
.login-link {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
}

.login-link a {
    color: #4CAF50;
    text-decoration: none;
    font-weight: 500;
}

.login-link a:hover {
    text-decoration: underline;
}

</style>
</head>
<body>
<div class="register-container">
    <h2>Create Your Account</h2>
    
    <?php if(!empty($error)) echo "<div class='error'>$error</div>"; ?>
    
    <form method="POST" action="">
        <div class="input-group">
            <label for="ID">ID</label>
            <input type="text" id="ID" name="ID" required>
        </div>
        <div class="input-group">
            <label for="USERNAME">Username</label>
            <input type="text" id="USERNAME" name="USERNAME" required>
        </div>
        <div class="input-group">
            <label for="PW">Password</label>
            <input type="password" id="PW" name="PW" required>
        </div>
        <button type="submit" class="register-button">Register</button>
    </form>

    <div class="login-link">
        <p>Already have an account? <a href="index.php">Login here</a></p>
    </div>
</div>
</body>
</html>
