<?php
$host = "localhost";
$dbname = "pet_adoption";
$username = "root";
$password = "";

// Database connection
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed.']));
}

$result = $conn->query("SELECT * FROM pets");
$pets = [];

while ($row = $result->fetch_assoc()) {
    $pets[] = $row;
    echo "
    <div class='pet-card'>
        <img src='{$row['image']}' alt='{$row['name']}'>
        <h3>{$row['name']}</h3>
        <p>Breed: {$row['breed']}</p>
        <p>Age: {$row['age']} years</p>
        <p>Price: Rs. {$row['price']}</p>
        <p>{$row['description']}</p>
    </div>
    ";
}

echo json_encode(['success' => true, 'pets' => $pets]);

$conn->close();
?>