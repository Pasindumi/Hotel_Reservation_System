<?php
session_start();

// Database connection
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "hoteldb";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get input
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username && $password) {
    // Query (password stored as MD5 hash for demo)
    $sql = "SELECT * FROM users WHERE username=? AND password=MD5(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        // Redirect to homepage after login
        header("Location: index.php");
        exit();
    } else {
        echo "<h3 style='color:red;'>Invalid username or password</h3>";
        echo "<a href='login.html'>Go Back</a>";
    }

    $stmt->close();
}
$conn->close();
?>
