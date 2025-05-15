<?php
include_once "../config/db.php";
header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['quality_id'] ?? null;

    if (!$id) {
        echo json_encode(["success" => false, "message" => "Record ID is required"]);
        exit();
    }

    $sql = "DELETE FROM waterquality WHERE quality_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Record deleted successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete record"]);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
}
$conn->close();
?>