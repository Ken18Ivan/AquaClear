<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart AquaClear | Manage Data</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../includes/header.php'; ?>

    <div class="container-fluid flex-grow-1">
        <div class="row">
            <?php include '../includes/sidebar.php'; ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3 border-bottom d-flex justify-content-between align-items-center">
                    <h1 class="h2">Water Quality Records</h1>
                    <button class="btn btn-primary" id="addRecord">
                        <i class="fas fa-plus"></i> Add New
                    </button>
                </div>

                <div class="table-responsive glass-card">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Timestamp</th>
                                <th>pH</th>
                                <th>Turbidity</th>
                                <th>Temperature</th>
                                <th>TDS</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="recordsData">
                            <!-- Dynamic data will be loaded here -->
                        </tbody>
                    </table>
                </div>

                <!-- Modal for Adding/Editing Records -->
                <div class="modal fade" id="recordModal" tabindex="-1" aria-labelledby="recordModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content glass-card">
                            <form id="recordForm">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="recordModalLabel">Water Quality Record</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="qualityId">
                                    <div class="mb-3">
                                        <label for="sensorId" class="form-label">Sensor</label>
                                        <input type="number" class="form-control" id="sensorId" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phValue" class="form-label">pH Value</label>
                                        <input type="number" class="form-control" id="phValue" step="0.1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="turbidityValue" class="form-label">Turbidity (NTU)</label>
                                        <input type="number" class="form-control" id="turbidityValue" step="0.1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tempValue" class="form-label">Temperature (°C)</label>
                                        <input type="number" class="form-control" id="tempValue" step="0.1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tdsValue" class="form-label">TDS (ppm)</label>
                                        <input type="number" class="form-control" id="tdsValue" step="0.1" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>