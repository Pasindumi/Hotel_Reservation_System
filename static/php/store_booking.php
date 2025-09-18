<?php
session_start();
$userSession = $_SESSION['username']; // from login

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "hoteldb";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$room_id = $_POST['room_id'];
$room_name = $_POST['room_name'];
$room_size = $_POST['room_size'];
$room_bed = $_POST['room_bed'];
$price = $_POST['price'];

$check_in_date = $_POST['check_in_date'];
$check_out_date = $_POST['check_out_date'];
$rooms = $_POST['rooms'];
$adults = $_POST['adults'];
$children = $_POST['children'];

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$country = $_POST['country'];
$requests = $_POST['requests'];

$stmt = $conn->prepare("INSERT INTO bookings 
(room_id, room_name, room_size, room_bed, price, check_in_date, check_out_date, rooms, adults, children, first_name, last_name, phone, email, country, requests, username)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssisiiisssssss", $room_id, $room_name, $room_size, $room_bed, $price, $check_in_date, $check_out_date, $rooms, $adults, $children, $first_name, $last_name, $phone, $email, $country, $requests, $userSession);

if($stmt->execute()){
    header("Location: checkout_summary.php?booking_id=".$conn->insert_id);
} else {
    echo "Error: ".$stmt->error;
}

$stmt->close();
$conn->close();
?>
