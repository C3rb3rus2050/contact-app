<?php
// Database configuration
$servername = "db";           // docker-compose service name
$username = "user";            // MySQL user
$password = "userpassword";    // MySQL password
$dbname = "mydb";              // database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Only process POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $message = $_POST['message'] ?? '';
    $priority = $_POST['priority'] ?? 2;
    $type = $_POST['type'] ?? 1;
    $terms = isset($_POST['terms']) ? 1 : 0;

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contacts (name, message, priority, type, terms) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiii", $name, $message, $priority, $type, $terms);

    if ($stmt->execute()) {
        echo "<h2>Your message has been submitted successfully!</h2>";
        echo "<a href='index.php'>Go back to form</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
