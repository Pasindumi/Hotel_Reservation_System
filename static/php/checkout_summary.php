<?php
// checkout_summary.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hoteldb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$booking_id = $_GET['booking_id'] ?? 0;

// Get booking + room details
// If your primary key is booking_id
$stmt = $conn->prepare("SELECT * FROM bookings WHERE booking_id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    die("Booking not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Checkout Summary</title>
<style>
    /* Full page background */
    body, html {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: url('../images/checkout_bg.jpg') no-repeat center center fixed;
        background-size: cover;
        height: 100%;
        color: #333;
    }

    /* Overlay for readability */
    body::before {
        content: "";
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: -1;
    }

    /* Main container */
    .container {
        max-width: 1000px;
        margin: 60px auto;
        background: rgba(255,255,255,0.95);
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.3);
        overflow: hidden;
        animation: fadeUp 1.2s ease-in-out;
    }

    /* Title */
    .title {
        text-align: center;
        padding: 30px;
        background: #a87c4f;
        color: #fff;
        font-size: 2em;
        font-weight: bold;
    }

    /* Flex layout */
    .main-section {
        display: flex;
        justify-content: space-between;
        gap: 40px;
        padding: 40px;
        position: relative;
    }

    /* Vertical divider */
    .main-section::after {
        content: "";
        position: absolute;
        top: 30px;
        bottom: 30px;
        left: 50%;
        width: 2px;
        background: #ccc;
    }

    /* Left and Right sections */
    .section-left, .section-right {
        width: 48%;
    }

    /* Section headings */
    h3 {
        color: #a87c4f;
        margin-bottom: 15px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 5px;
    }

    /* Table styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table td {
        padding: 12px;
        font-size: 15px;
    }

    table td.label {
        font-weight: bold;
        color: #444;
        width: 40%;
    }

    /* Total price */
    .total-price {
        text-align: right;
        font-size: 22px;
        font-weight: bold;
        margin-top: 20px;
        color: #a87c4f;
    }

    /* Button */
    .btn {
        display: block;
        margin: 30px auto;
        padding: 15px 50px;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        background: linear-gradient(135deg, #d4a373, #a87c4f);
        border: none;
        border-radius: 30px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
    }

    .btn:hover {
        background: linear-gradient(135deg, #a87c4f, #d4a373);
        transform: scale(1.05);
    }

    /* Animations */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(50px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
</head>
<body>

<div class="container">
    <div class="title">Booking Summary</div>

    <div class="main-section">
        <!-- Left: Room Details -->
        <div class="section-left">
            <h3>Room Details</h3>
            <table>
                <tr><td class="label">Room Name:</td><td><?php echo htmlspecialchars($booking['room_name']); ?></td></tr>
                <tr><td class="label">Room Type / Bed:</td><td><?php echo htmlspecialchars($booking['room_bed'] ?? 'N/A'); ?></td></tr>
                <tr><td class="label">Check-In Date:</td><td><?php echo htmlspecialchars($booking['check_in']); ?></td></tr>
                <tr><td class="label">Check-Out Date:</td><td><?php echo htmlspecialchars($booking['check_out']); ?></td></tr>
                <tr><td class="label">Number of Rooms:</td><td><?php echo htmlspecialchars($booking['rooms']); ?></td></tr>
                <tr><td class="label">Number of Adults:</td><td><?php echo htmlspecialchars($booking['adults']); ?></td></tr>
                <tr><td class="label">Number of Children:</td><td><?php echo htmlspecialchars($booking['children']); ?></td></tr>
            </table>
        </div>

        <!-- Right: Guest Details -->
        <div class="section-right">
            <h3>Guest Details</h3>
            <table>
                <tr><td class="label">First Name:</td><td><?php echo htmlspecialchars($booking['first_name']); ?></td></tr>
                <tr><td class="label">Last Name:</td><td><?php echo htmlspecialchars($booking['last_name']); ?></td></tr>
                <tr><td class="label">Phone:</td><td><?php echo htmlspecialchars($booking['phone']); ?></td></tr>
                <tr><td class="label">Email:</td><td><?php echo htmlspecialchars($booking['email']); ?></td></tr>
                <tr><td class="label">Country:</td><td><?php echo htmlspecialchars($booking['country']); ?></td></tr>
                <tr><td class="label">Special Requests:</td><td><?php echo htmlspecialchars($booking['requests']); ?></td></tr>
            </table>

            <div class="total-price">
                Total: ₹ <?php echo number_format($booking['price']); ?>
            </div>
        </div>
    </div>

    <a href="index.php" class="btn">Back to Home</a>
</div>

</body>
</html>
