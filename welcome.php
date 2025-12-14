<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $no = htmlspecialchars($_POST['no'] ?? '');
    $unic_id =  rand(9999999,99999999999);
    $lecture_details = htmlspecialchars($_POST['lecture_details'] ?? '');
    $start = $_POST['start'] ?? '';
    $end = $_POST['end'] ?? '';

    // Prepare and execute insert statement
    $stmt = $conn->prepare("INSERT INTO lectures (no, unic_id, lecture_details, start_datetime, end_datetime) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $no, $unic_id, $lecture_details, $start, $end);

    if ($stmt->execute()) {
        $success_message = "Lecture details stored successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch all lectures from database
$lectures = [];
$result = $conn->query("SELECT * FROM lectures ORDER BY created_at DESC");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lectures[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecture Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .lecture-card {
            transition: all 0.3s ease;
        }
        .lecture-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .required-field::after {
            content: " *";
            color: red;
        }
    </style>
</head>
<body class="bg-light">


<div class="container py-5">
    <div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="h4 mb-0"><i class="bi bi-journal-text"></i> Lecture Information Form</h2>
                </div>
                <div class="card-body">
                    <?php if (isset($success_message)): ?>
                       <div class="alert alert-success"><?php echo $success_message; ?></div>
                        <?php endif; ?>
                        <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="lecture_details" class="form-label required-field">Lecture Details</label>
                        <textarea class="form-control" id="lecture_details" name="lecture_details" rows="3" required></textarea>
                    </div>

                <div class="col-md-6">
                    <label for="start" class="form-label required-field">Start Date & Time</label>
                    <input type="datetime-local" class="form-control" id="start" name="start" required>
                </div>

                <div class="col-md-6">
                    <label for="end" class="form-label required-field">End Date & Time</label>
                    <input type="datetime-local" class="form-control" id="end" name="end" required>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save"></i> Submit
                    </button>
                
                    <a href = "student_records.php" class = "btn btn-primary">Student Details</a>
                </div>
            </div>
            </form>
        </div>
    </div>

    <div class="card shadow mt-5">
    <div class="card-header bg-success text-white">
        <h2 class="h4 mb-0"><i class="bi bi-list-check"></i> Submitted Lectures</h2>
    </div>
    <div class="card-body">
        <?php if (empty($lectures)): ?>
        <div class="alert alert-info">No lectures found. Please add some using the form above.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Unique ID</th>
                            <th>Lecture Details</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Created</th>
                            <th>Code</th>
                            <th>Print</th>
                            <th>Download Attendance</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php foreach ($lectures as $lecture): ?>
        <tr>
            <td><?php echo htmlspecialchars($lecture['unic_id']); ?></td>
            <td><?php echo htmlspecialchars($lecture['lecture_details']); ?></td>
            <td><?php echo date('M j, Y H:i', strtotime($lecture['start_datetime'])); ?></td>
            <td><?php echo date('M j, Y H:i', strtotime($lecture['end_datetime'])); ?></td>
            <td><?php echo date('M j, Y', strtotime($lecture['created_at'])); ?></td>
            <td><img src="https://qrcode.tec-it.com/API/QRCode?data=<?php echo htmlspecialchars($lecture['unic_id']); ?>" alt="QR Code" width = "70"></td>
            <td><a href = 'print_attendance.php?unic_id=<?php echo htmlspecialchars($lecture['unic_id']); ?>'>Print</a></td><td>
   
    <form action="download_attendance_pdf.php" method="GET" style="display:inline;">
        <input type="hidden" name="unic_id" value="<?php echo htmlspecialchars($lecture['unic_id']); ?>">
        <input type="date" name="attendance_date" class="form-control form-control-sm" required>
        <button type="submit" class="btn btn-success btn-sm mt-1">Download PDF</button>
    </form>
</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                 <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>