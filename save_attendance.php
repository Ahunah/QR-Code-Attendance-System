<?php
header("Content-Type: application/json");

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Get JSON input (for POST requests)
$input = json_decode(file_get_contents('php://input'), true);

// Alternatively, for GET/POST form data:

$attendance_code = $_REQUEST['attendance_code'] ?? '';
$student_id = $_REQUEST['student_id'] ?? '';
$student_name = $_REQUEST['student_name'] ?? '';
$location_x = $_REQUEST['location_x'] ?? 0;
$location_y = $_REQUEST['location_y'] ?? 0;
$save_at = $_REQUEST['save_at'] ?? date("Y/m/d h:i:s a");

// Validate required fields
if (empty($attendance_code) || empty($student_id)) {
    echo json_encode(["status" => "error", "message" => "Missing required fields"]);
    exit;
}

// Prepare and bind SQL (prevent SQL injection)
$stmt = $conn->prepare("INSERT INTO attendance_records 
    (attendance_code, student_id, student_name, location_x, location_y, save_at) 
    VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssdds", 
    $attendance_code, 
    $student_id, 
    $student_name, 
    $location_x, 
    $location_y, 
    $save_at,
    
);

// Execute and respond
if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Attendance recorded!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>