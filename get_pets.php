<?php
header('Content-Type: application/json');

$host = "localhost";
$dbname = "pet_adoption";
$username = "root";
$password = "";
// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed.']));
}

// Fetch all pets
$sql = "SELECT id, name, breed, age, price, image FROM pets WHERE is_adopted = 0";
$result = $conn->query($sql);

$pets = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pets[] = $row;
    }
}

echo json_encode(['success' => true, 'pets' => $pets]);
$conn->close();
?>