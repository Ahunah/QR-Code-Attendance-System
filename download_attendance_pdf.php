<?php
// Enable error reporting (optional, for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database configuration
include 'config.php';

// Include the FPDF library
require_once('fpdf/fpdf.php');

// Check if the lecture unique ID is provided in the URL
if (!isset($_GET['unic_id']) || empty($_GET['unic_id'])) {
    die("Error: Unique ID is required.");
}

$unic_id = $_GET['unic_id'];
$attendance_date = $_GET['attendance_date'] ?? null; // Get attendance date from URL

// Fetch lecture details from the 'lectures' table using the unic_id
$lecture_details_query = $conn->prepare("SELECT lecture_details FROM lectures WHERE unic_id = ?");
$lecture_details_query->bind_param("s", $unic_id);
$lecture_details_query->execute();
$lecture_details_result = $lecture_details_query->get_result();
$lecture_data = $lecture_details_result->fetch_assoc();
$lecture_details = $lecture_data['lecture_details'] ?? 'N/A'; // Default to 'N/A' if not found
$lecture_details_query->close();


// Fetch attendance records matching the unique ID and optional date
// Removed 'save_at' from the SELECT query
$sql = "SELECT student_id, student_name, location_x, location_y FROM attendance_records WHERE attendance_code = ?";
$params = [$unic_id];
$types = "s";

if ($attendance_date) {
    $sql .= " AND DATE(save_at) = ?"; // Filter by date part only
    $params[] = $attendance_date;
    $types .= "s";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("No attendance records found for Unique ID: " . htmlspecialchars($unic_id) . ($attendance_date ? " on " . htmlspecialchars($attendance_date) : ""));
}

// Extend FPDF to add custom header, footer and table
class PDF extends FPDF
{
    protected $unic_id;
    protected $attendance_date;
    protected $lecture_details_header; 

    function setLectureInfo($unic_id, $attendance_date, $lecture_details) {
        $this->unic_id = $unic_id;
        $this->attendance_date = $attendance_date;
        $this->lecture_details_header = $lecture_details; 
    }

    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Attendance Report', 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 7, 'Lecture Unique ID: ' . $this->unic_id, 0, 1, 'C');
        if ($this->attendance_date) {
            $this->Cell(0, 7, 'Date: ' . $this->attendance_date, 0, 1, 'C');
        }
        // Ensure this line is within the available width, especially if lecture details are long
        $this->Cell(0, 7, 'Lecture details: ' . $this->lecture_details_header, 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetY(-15); 
        $this->SetFont('Arial', 'I', 8); 
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'R'); 
    }

    function TableHeader()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(220, 220, 220); // A lighter grey for header background
        $this->SetTextColor(0); // Black text
        $this->Cell(40, 10, 'Student ID', 1, 0, 'C', true); // Increased width
        $this->Cell(70, 10, 'Student Name', 1, 0, 'C', true); // Increased width
        $this->Cell(40, 10, 'Latitude', 1, 0, 'C', true);   // Adjusted width
        $this->Cell(40, 10, 'Longitude', 1, 1, 'C', true);  // Adjusted width
        $this->SetTextColor(0); // Reset text color for data rows
    }
}

$pdf = new PDF();
$pdf->AliasNbPages(); 
$pdf->setLectureInfo($unic_id, $attendance_date, $lecture_details);
$pdf->AddPage();
$pdf->TableHeader();
$pdf->SetFont('Arial', '', 10); // Slightly smaller font for data rows to fit better

// Output data rows
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(40, 7, $row['student_id'], 1); // Consistent height with header
    $pdf->Cell(70, 7, $row['student_name'], 1); 
    $pdf->Cell(40, 7, $row['location_x'], 1);
    $pdf->Cell(40, 7, $row['location_y'], 1, 1); 
}

// Output the PDF as a download
$pdf->Output('D', "attendance_report_{$unic_id}" . ($attendance_date ? "_".$attendance_date : "") . ".pdf");

// Close database connections
$stmt->close();
$conn->close();

exit();
?>