<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lecture Records</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="text-center">Lecture Records</h2>
                    </div>
                    <div class="card-body">
                        <form method="get" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="unic_id" class="form-control" placeholder="Enter UNIC ID" value="<?php echo htmlspecialchars($_GET['unic_id'] ?? ''); ?>" />
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>

                        <?php
                        $db = new PDO('mysql:host=localhost;dbname=attendance', 'root', '');
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $unic_id = $_GET['unic_id'] ?? null;

                        if ($unic_id) {
                            try {
                                $stmt = $db->prepare("SELECT * FROM lectures WHERE unic_id = ?");
                                $stmt->execute([$unic_id]);
                                $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                if ($records) {
                                    echo '<div class="table-responsive">';
                                    echo '<table class="table table-striped table-hover">';
                                    echo '<thead class="table-dark">';
                                    echo '<tr><th>Details</th><th>Start Date/Time</th><th>End Date/Time</th></tr>';
                                    echo '</thead><tbody>';

                                    foreach ($records as $record) {
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($record['lecture_details']) . '</td>';
                                        echo '<td>' . htmlspecialchars($record['start_datetime']) . '</td>';
                                        echo '<td>' . htmlspecialchars($record['end_datetime']) . '</td>';
                                        echo '</tr>';
                                    }

                                    echo '</tbody></table></div>';
                                } else {
                                    echo '<div class="alert alert-warning">No records found for UNIC ID: ' . htmlspecialchars($unic_id) . '</div>';
                                }
                            } catch (PDOException $e) {
                                echo '<div class="alert alert-danger">Database error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                            }
                        } else {
                            echo '<div class="alert alert-info">Please enter a UNIC ID to search</div>';
                        }
                        ?>

                        <?php if (!empty($records) && isset($records[0]['unic_id'])): ?>
                            <div id="qrCodeContainer" class="text-center m-4">
                                <h4>Lecture QR Code</h4>
                                <img class="qr-code" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo urlencode($records[0]['unic_id']); ?>" 
                                    alt="QR Code for <?php echo htmlspecialchars($records[0]['unic_id']); ?>" />
                                <p id="timer" class="mt-2 text-danger fw-bold">QR code expires in 90 seconds</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer text-muted">
                        <?php echo date('Y-m-d H:i:s'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var timeLeft = 90; // seconds
        var timerElement = document.getElementById('timer');
        var qrCodeDiv = document.getElementById('qrCodeContainer');

        if (timerElement && qrCodeDiv) {
            var countdown = setInterval(function() {
                timeLeft--;

                if (timeLeft > 0) {
                    timerElement.textContent = 'QR code expires in ' + timeLeft + ' second' + (timeLeft === 1 ? '' : 's');
                } else {
                    clearInterval(countdown);
                    qrCodeDiv.style.display = 'none';
                    // No alert for silent expiration
                }
            }, 1000);
        }
    </script>
</body>
</html>
