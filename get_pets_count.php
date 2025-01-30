<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pet_adoption";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed."]));
}

// Get total pets count
// $sql = "SELECT COUNT(*) AS total FROM pets";
// $result = $conn->query($sql);

// if ($result && $row = $result->fetch_assoc()) {
//     echo json_encode(["success" => true, "total" => $row['total']]);
// } else {
//     echo json_encode(["success" => false, "message" => "Failed to fetch pet count."]);
// }

// Fetch counts for available and adopted pets
$availableCountQuery = "SELECT COUNT(*) AS available FROM pets WHERE is_adopted = 0";
$adoptedCountQuery = "SELECT COUNT(*) AS adopted FROM pets WHERE is_adopted = 1";

$availableResult = $conn->query($availableCountQuery);
$adoptedResult = $conn->query($adoptedCountQuery);

if ($availableResult && $adoptedResult) {
    $availableCount = $availableResult->fetch_assoc()['available'];
    $adoptedCount = $adoptedResult->fetch_assoc()['adopted'];

    echo json_encode([
        'success' => true,
        'available' => $availableCount,
        'adopted' => $adoptedCount
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error fetching counts.']);
}


$conn->close();
?>