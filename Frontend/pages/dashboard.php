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
    <title>Smart AquaClear | Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="dashboard-body">
    <?php include '../includes/header.php'; ?>
    
    <div class="dashboard-wrapper">
        <?php include '../includes/sidebar.php'; ?>
        
        <main class="dashboard-main">
            <div class="dashboard-container">
                <!-- Stats Section -->
                <div class="stats-row">
                    <div class="glass-card">
                        <i class="fas fa-water icon"></i>
                        <div class="stats-content">
                            <h3>pH Level</h3>
                            <span class="live-value" id="livePh">7.8</span>
                        </div>
                    </div>

                    <div class="glass-card">
                        <i class="fas fa-wave-square icon"></i>
                        <div class="stats-content">
                            <h3>Turbidity</h3>
                            <span class="live-value" id="liveTurbidity">12.4 NTU</span>
                        </div>
                    </div>

                    <div class="glass-card">
                        <i class="fas fa-thermometer-half icon"></i>
                        <div class="stats-content">
                            <h3>Temperature</h3>
                            <span class="live-value" id="liveTemp">24.5°C</span>
                        </div>
                    </div>

                    <div class="glass-card">
                        <i class="fas fa-microscope icon"></i>
                        <div class="stats-content">
                            <h3>TDS</h3>
                            <span class="live-value" id="liveTds">158 ppm</span>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="chart-container">
                    <div class="glass-card wide">
                        <h3>Water Quality Trends</h3>
                        <canvas id="qualityChart"></canvas>
                    </div>

                    <div class="glass-card">
                        <h3>System Health</h3>
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>

                <!-- Recent Readings Section -->
                <div class="glass-card wide">
                    <div class="table-header">
                        <h3>Recent Readings</h3>
                        <div class="table-controls">
                            <input type="text" placeholder="Search readings..." id="searchInput">
                            <button class="btn-refresh" id="refreshData" aria-label="Refresh Data">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                    <table class="sensor-table">
                        <thead>
                            <tr>
                                <th>Timestamp</th>
                                <th>pH</th>
                                <th>Turbidity</th>
                                <th>Temperature</th>
                                <th>TDS</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="readingsTable">
                            <!-- Dynamic sensor readings -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <?php include '../includes/footer.php'; ?>
    <script src="../assets/js/main.js"></script>
</body>
</html>
