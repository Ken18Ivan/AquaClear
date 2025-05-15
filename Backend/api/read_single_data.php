<?php
include_once "../config/db.php";
header('Content-Type: application/json');

try {
    // Get the ID from the query string
    $id = $_GET['id'] ?? null;

    // Validate the ID
    if (!$id) {
        echo json_encode(["success" => false, "message" => "Record ID is required"]);
        exit();
    }

    // Prepare the SQL query to fetch the record
    $sql = "SELECT * FROM waterquality WHERE quality_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the record exists
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode(["success" => true, "data" => $data]);
    } else {
        echo json_encode(["success" => false, "message" => "Record not found"]);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
}

// Close the database connection
$conn->close();
?>