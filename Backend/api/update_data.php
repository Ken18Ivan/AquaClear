<?php
include_once "../config/db.php";
header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data['id']; // quality_id
    $sensor_id = $data['sensor_id'];
    $ph = $data['ph'];
    $turbidity = $data['turbidity'];
    $temperature = $data['temperature'];
    $tds = $data['tds'];

    if (empty($id) || empty($sensor_id) || empty($ph) || empty($turbidity) || empty($temperature) || empty($tds)) {
        echo json_encode(["success" => false, "message" => "All fields are required"]);
        exit();
    }

    $sql = "UPDATE waterquality SET sensor_id = ?, ph = ?, turbidity = ?, temperature = ?, tds = ? WHERE quality_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iddddi", $sensor_id, $ph, $turbidity, $temperature, $tds, $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Record updated successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update record"]);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
}
$conn->close();
?>