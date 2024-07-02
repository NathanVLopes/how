<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chat";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $message = $_POST['message'];
    $stmt = $conn->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $message);
    $stmt->execute();
    $stmt->close();
} else {
    $result = $conn->query("SELECT * FROM messages ORDER BY timestamp DESC");
    while ($row = $result->fetch_assoc()) {
        echo "<div><strong>" . $row['username'] . ":</strong> " . $row['message'] . "<br><small>" . $row['timestamp'] . "</small></div>";
    }
}

$conn->close();
?>
