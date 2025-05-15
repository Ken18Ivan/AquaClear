<?php
include_once "../config/db.php";
header('Content-Type: application/json');

try {
    $rawInput = file_get_contents("php://input");
    error_log("Raw Input: " . $rawInput);
    $data = json_decode($rawInput, true);

    if ($data === null) {
        error_log("JSON Decode Error: " . json_last_error_msg());
        echo json_encode(["success" => false, "message" => "Invalid JSON format"]);
        exit;
    }

    if (!isset($data['ph'], $data['turbidity'], $data['temperature'], $data['tds'], $data['sensor_id'])) {
        echo json_encode(["success" => false, "message" => "Invalid input data"]);
        exit;
    }

    $ph = floatval($data['ph']);
    $turbidity = floatval($data['turbidity']);
    $temperature = floatval($data['temperature']);
    $tds = floatval($data['tds']);
    $sensor_id = intval($data['sensor_id']);

    // Start transaction
    $conn->begin_transaction();
    try {
        // Insert new record
        $sql = "INSERT INTO waterquality (ph, turbidity, temperature, tds, sensor_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Database error: Failed to prepare statement");
        }

        $stmt->bind_param("ddddi", $ph, $turbidity, $temperature, $tds, $sensor_id);

        if ($stmt->execute()) {
            $conn->commit();
            echo json_encode(["success" => true, "message" => "Record added successfully"]);
        } else {
            throw new Exception($conn->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        $conn->rollback();
        error_log("Transaction failed: " . $e->getMessage());
        echo json_encode(["success" => false, "message" => "Transaction failed: " . $e->getMessage()]);
    }
} catch (Exception $e) {
    error_log("Exception: " . $e->getMessage());
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
} finally {
    $conn->close();
}
?>
