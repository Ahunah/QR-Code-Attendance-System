<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST['ID'] ?? '';
    $PW = $_POST['PW'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM user WHERE ID=?");
    $stmt->bind_param("s", $ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if($PW === $row['PW']){  // Plain text password check
            $_SESSION['loggedin'] = true;
            $_SESSION['ID'] = $ID;
            $_SESSION['USERNAME'] = $row['USERNAME'];

            $update = $conn->prepare("UPDATE user SET STATUS='logged_in' WHERE ID=?");
            $update->bind_param("s", $ID);
            $update->execute();

            header("Location: welcome.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid ID or Password!";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "No account found. Please register!";
        header("Location: index.php");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>
