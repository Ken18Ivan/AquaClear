<?php
include_once "../Backend/config/db.php";

if ($conn->ping()) {
    echo "Database connection successful!";
} else {
    echo "Database connection failed: " . $conn->connect_error;
}
?>