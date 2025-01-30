<?php
// add_pet.php
header('Content-Type: application/json');

$host = "localhost";
$dbname = "pet_adoption";
$username = "root";
$password = "";

// Database connection
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed.']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = '';

    // Handle file upload
    if (isset($_FILES['pet_image']) && $_FILES['pet_image']['error'] === UPLOAD_ERR_OK) {
        $imagePath = 'uploads/' . uniqid() . '_' . $_FILES['pet_image']['name'];
        move_uploaded_file($_FILES['pet_image']['tmp_name'], $imagePath);
        $image = $imagePath;
    }

    // Insert pet into the database
    $stmt = $conn->prepare('INSERT INTO pets (name, breed, age, description, price, image) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('ssisss', $name, $breed, $age, $description, $price, $image);

    if ($stmt->execute()) {
        $petId = $stmt->insert_id; // Get the ID of the newly inserted pet
        echo json_encode([
            'success' => true,
            'pet' => [
                'id' => $petId,
                'name' => $name,
                'breed' => $breed,
                'age' => $age,
                'description' => $description,
                'price' => $price,
                'image' => $image
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add pet.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$conn->close();
?>