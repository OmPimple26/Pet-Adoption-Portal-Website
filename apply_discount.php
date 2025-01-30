<?php
// apply_discount.php
header('Content-Type: application/json');

// Database connection (update with your DB credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pet_adoption";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed."]));
}

// Get POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $discount = $_POST['discount'];

    // Validate input
    if (!empty($username) && is_numeric($discount) && $discount >= 0 && $discount <= 100) {
        $stmt = $conn->prepare("INSERT INTO discounts (username, discount) VALUES (?, ?)");
        $stmt->bind_param('si', $username, $discount);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'data' => ['username' => $username, 'discount' => $discount]]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to apply discount']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
    }
}

$conn->close();
?>