<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "HotelDB";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
}

// Get input
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];

// Check if passwords match
if ($password !== $confirm_password) {
         echo "<h3 style='color:red;'>Passwords do not match!</h3>";
         echo "<a href='signup.html'>Go Back</a>";
         exit();
}

// Check if username exists
$sql = "SELECT * FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
         echo "<h3 style='color:red;'>Username already exists!</h3>";
         echo "<a href='signup.html'>Go Back</a>";
         exit();
}

// Insert new user (password stored as MD5 hash for demo)
$sql = "INSERT INTO users (username, password, email, address, phone) VALUES (?, MD5(?), ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $username, $password, $email, $address, $phone);

if ($stmt->execute()) {
         echo "<h3 style='color:green;'>Registration successful!</h3>";
         echo "<a href='login.html'>Click here to Login</a>";
} else {
         echo "<h3 style='color:red;'>Error: " . $conn->error . "</h3>";
}

$stmt->close();
$conn->close();
