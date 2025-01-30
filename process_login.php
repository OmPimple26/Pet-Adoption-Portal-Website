<?php
// Database configuration
$host = "localhost"; // Update with your server details
$dbname = "pet_adoption"; // Update with your database name
$username = "root"; // Database username
$password = ""; // Database password

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$user = $_POST['username'];
$pass = $_POST['password'];
$role = $_POST['role'];

// Hash the password before storing
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

// Prepare an SQL statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $user, $hashed_password, $role);

// Execute the statement and redirect based on the role
if ($stmt->execute()) {
    // Redirect to the appropriate page based on role
    if ($role === "admin"  && ($user === 'Om' && $pass === '1234')) {
        header("Location: admin_panel.html");
    }else if($role == "user"  && ($user === 'Ibrahim' && $pass === '123')){
        header("Location: user_panel.html");
    }else{
        // Incorrect username or password
        echo "<script>
                alert('Please enter the correct username and password.');
                window.location.href = 'login.html'; // Redirect back to the login page
              </script>";
    }
    exit; // Terminate the script to ensure the redirect happens
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>