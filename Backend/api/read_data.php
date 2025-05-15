<?php
include_once "../config/db.php";
header('Content-Type: application/json');

try {
    $sql = "SELECT * FROM waterquality ORDER BY reading_time DESC"; // Fetch all records
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row; // Add each record to the data array
        }
        echo json_encode(["success" => true, "data" => $data]);
    } else {
        echo json_encode(["success" => false, "message" => "No records found"]);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
}
$conn->close();
?>