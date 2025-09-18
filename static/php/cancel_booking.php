<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.html");
    exit();
}

if(isset($_POST['booking_id'])){
    $booking_id = $_POST['booking_id'];
    $username = $_SESSION['username'];

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "hoteldb";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    if($conn->connect_error) die("Connection failed: ".$conn->connect_error);

    // Delete reservation but ensure it belongs to this user
    $stmt = $conn->prepare("DELETE FROM bookings WHERE booking_id=? AND username=?");
    $stmt->bind_param("is", $booking_id, $username);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: cancel_reservations.php");
    exit();
}
?>
