<?php
header('Content-Type: application/json');

// Database connection
$host = "localhost";
$dbname = "pet_adoption";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $pet_id = intval($_POST['pet_id']);

    // Delete pet from database
//     $query = "DELETE FROM pets WHERE id = ?";
//     $stmt = $conn->prepare($query);
//     $stmt->bind_param("i", $pet_id);

//     if ($stmt->execute()) {
//         echo json_encode(['success' => true]);
//     } else {
//         echo json_encode(['success' => false, 'message' => 'Failed to delete pet.']);
//     }
// } else {
//     echo json_encode(['success' => false, 'message' => 'Invalid request.']);
// }

// Retrieve form data
$pet_id = $_POST['pet_id'];
$user_id = 1; // Example user ID (replace this with the actual user ID if available)

// Check if the pet exists and is not already adopted
$check_pet = $conn->prepare("SELECT id FROM pets WHERE id = ? AND is_adopted = 0");
$check_pet->bind_param('i', $pet_id);
$check_pet->execute();
$result = $check_pet->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Pet not available for adoption.']);
    $conn->close();
    exit;
}

// Mark pet as adopted
$update_pet = $conn->prepare("UPDATE pets SET is_adopted = 1 WHERE id = ?");
$update_pet->bind_param('i', $pet_id);

if ($update_pet->execute()) {
    // Add record to the adopted_pets table
    $add_adoption = $conn->prepare("INSERT INTO adopted_pets (user_id, pet_id, adoption_date) VALUES (?, ?, NOW())");
    $add_adoption->bind_param('ii', $user_id, $pet_id);
    $add_adoption->execute();

    echo json_encode(['success' => true, 'message' => 'Pet adopted successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to adopt the pet.']);
}

$conn->close();
?>