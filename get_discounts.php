<?php
$host = "localhost";
$dbname = "pet_adoption";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed.']));
}

$query = "SELECT * FROM discounts";
$result = $conn->query($query);

$discounts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $discounts[] = [
            'username' => $row['username'],
            'discount' => $row['discount']
        ];
    }
}

echo json_encode(['discounts' => $discounts]);
$conn->close();
?>