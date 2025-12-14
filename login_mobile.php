<?php
// Include database configuration
include 'config.php';

// Set content type to JSON
header('Content-Type: application/json');

// Initialize response array
$response = [
    'success' => false,
    'message' => '',
    'user' => null
];

// Check if ID and PW parameters exist
if (!isset($_GET['ID']) || !isset($_GET['PW'])) {
    $response['message'] = 'ID and password are required';
    echo json_encode($response);
    exit();
}

// Get form data
$id = $_GET['ID'];
$pw = $_GET['PW'];

try {
    // Prepare SQL to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE ID = ? AND PW = ?");
    $stmt->bind_param("ss", $id, $pw);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login successful
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $id;
        
        // Update status if needed
        $update_stmt = $conn->prepare("UPDATE user SET STATUS = 'logged_in' WHERE ID = ?");
        $update_stmt->bind_param("s", $id);
        $update_stmt->execute();
        
        $response['success'] = true;
        $response['message'] = 'Login successful';
        $response['user'] = [
            'id' => $id,
            'status' => 'logged_in'
        ];
    } else {
        // Login failed
        $response['message'] = 'Invalid ID or Password';
    }
    
    $stmt->close();
} catch (Exception $e) {
    $response['message'] = 'Database error: ' . $e->getMessage();
}

$conn->close();

// Output JSON response
echo json_encode($response);
?>