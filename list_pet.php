<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "pets_list";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle file upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["pet_image"]["name"]);
    move_uploaded_file($_FILES["pet_image"]["tmp_name"], $targetFile);

    $imagePath = $targetFile;

    // Insert pet details into the database
    $stmt = $conn->prepare("INSERT INTO pets (name, breed, age, description, image, price) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissi", $name, $breed, $age, $description, $imagePath, $price);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Pet listed successfully!", "pet" => [
            "name" => $name,
            "breed" => $breed,
            "age" => $age,
            "description" => $description,
            "image" => $imagePath,
            "price" => $price
        ]]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to list pet."]);
    }

    $stmt->close();
    $conn->close();
}
?>