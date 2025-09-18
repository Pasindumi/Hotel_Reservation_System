<?php
// Database connection
$servername = "localhost";
$dbusername = "root";   // default XAMPP username
$dbpassword = "";       // default XAMPP password is empty
$dbname = "HotelDB";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
}

// Get input
$username = $_POST['username'];
$password = $_POST['password'];

// Query (password stored as MD5 hash for demo)
$sql = "SELECT * FROM users WHERE username=? AND password=MD5(?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
         session_start();
         $_SESSION['username'] = $username;
         echo "<h2>Welcome, $username!</h2><p>Login successful.</p>";
         // You can redirect to dashboard.php
         // header("Location: dashboard.php");
} else {
         echo "<h3 style='color:red;'>Invalid username or password</h3>";
         echo "<a href='login.html'>Go Back</a>";
}

$stmt->close();
$conn->close();
