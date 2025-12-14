<?php

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Handle DELETE request
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $deleteParams);
    $id = $deleteParams['id'] ?? 0;
    
    $stmt = $conn->prepare("DELETE FROM attendance_records WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }
    exit;
}

// Handle GET request for fetching records
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fetch'])) {
    $result = $conn->query("SELECT * FROM attendance_records ORDER BY created_at DESC");
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Records</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Table CSS -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.css">
    <style>
        .action-btns { white-space: nowrap; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Attendance Records</h1>
        <table id="attendanceTable">
            <thead>
                <tr>
                    
                    <th data-field="attendance_code">Code</th>
                    <th data-field="student_id">Student ID</th>
                    <th data-field="student_name">Name</th>
                    <th data-field="location_x">Latitude</th>
                    <th data-field="location_y">Longitude</th>
                    <th data-field="save_at">Saved At</th>
                    <th data-field="actions" data-formatter="actionFormatter">Actions</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#attendanceTable').bootstrapTable({
            url: '?fetch=1',
            pagination: true,
            search: true,
            columns: [ {
                field: 'attendance_code',
                sortable: true
            }, {
                field: 'student_id',
                sortable: true
            }, {
                field: 'student_name',
                sortable: true
            }, {
                field: 'location_x',
                sortable: true
            }, {
                field: 'location_y',
                sortable: true
            }, {
                field: 'save_at',
                sortable: true
            }, {
                field: 'actions',
                formatter: actionFormatter,
                events: window.operateEvents
            }]
        });
    });

    function actionFormatter(value, row) {
        return `
            <div class="action-btns">
                <button class="btn btn-danger btn-sm delete-btn" data-id="${row.id}">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </div>
        `;
    }

    window.operateEvents = {
        'click .delete-btn': function(e, value, row) {
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                    url: '',
                    type: 'DELETE',
                    data: { id: row.id },
                    success: function(response) {
                        $('#attendanceTable').bootstrapTable('refresh');
                    },
                    error: function(xhr) {
                        alert('Error deleting record');
                    }
                });
            }
        }
    };
    </script>
</body>
</html>