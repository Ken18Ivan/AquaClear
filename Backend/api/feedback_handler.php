<?php
require_once '../config/db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Prepare SQL statement
        $stmt = $pdo->prepare("
            INSERT INTO feedback (user_id, name, email, subject, message, rating, submitted_at)
            VALUES (:user_id, :name, :email, :subject, :message, :rating, NOW())
        ");

        // Sanitize and validate input
        $data = [
            ':user_id' => $_SESSION['user_id'] ?? null, // Nullable if not logged in
            ':name' => filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING),
            ':email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            ':subject' => filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING),
            ':message' => filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING),
            ':rating' => filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT)
        ];

        // Validate required fields
        if (!$data[':name'] || !$data[':email'] || !$data[':subject'] || !$data[':message'] || !$data[':rating']) {
            echo json_encode([
                'success' => false,
                'message' => 'All fields are required and must be valid.'
            ]);
            exit;
        }

        // Execute the statement
        $stmt->execute($data);

        echo json_encode([
            'success' => true,
            'message' => 'Thank you for your feedback!'
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Failed to submit feedback: ' . $e->getMessage()
        ]);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
}