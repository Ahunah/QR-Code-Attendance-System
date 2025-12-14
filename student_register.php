<?php
$host = "localhost";   
$user = "root";        
$password_db = "";            
$db = "attendance"; 

$con = mysqli_connect($host, $user, $password_db, $db);

$username    = $_POST["username"] ?? '';
$studentid   = $_POST["studentid"] ?? '';
$password    = $_POST["password"] ?? '';
$conpassword = $_POST["conpassword"] ?? '';

// 🔹 Check if any field is empty
if (empty($username) || empty($studentid) || empty($password) || empty($conpassword)) {
    echo "All fields are required!";
    exit;
}

// 🔹 Check if passwords match
if ($password !== $conpassword) {
    echo "Password and Confirm Password do not match!";
    exit;
}

// 🔹 Insert into database
$sql = "INSERT INTO student_details (username, studentid, password, conpassword) 
        VALUES ('$username', '$studentid', '$password', '$conpassword')";

if (mysqli_query($con, $sql)) {
    echo "Done";
} else {
    echo "Something went wrong: " . mysqli_error($con);
}

mysqli_close($con);
?>
