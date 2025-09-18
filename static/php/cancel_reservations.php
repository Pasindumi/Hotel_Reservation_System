<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.html");
    exit();
}

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "hoteldb";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if($conn->connect_error) die("Connection failed: ".$conn->connect_error);

$username = $_SESSION['username'];

// Prepare statement
$sql = "SELECT * FROM bookings WHERE username=? ORDER BY booking_id DESC";
$stmt = $conn->prepare($sql);
if(!$stmt){
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cancel Reservations</title>
    <link rel="stylesheet" href="static/stylesheet/external.css">
      <link rel="stylesheet" href="../stylesheet/navbar.css">
    <style>
        table { width: 80%; margin: 40px auto; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 12px; text-align: center; }
        th { background-color: #a87c4f; color: white; }
        .btn_cancel { padding: 8px 20px; background: #d9534f; color: white; border: none; border-radius: 8px; cursor: pointer; transition: 0.3s; }
        .btn_cancel:hover { background: #c9302c; }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <h2 style="text-align:center; margin-top:30px;">Your Reservations</h2>

    <?php if($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Room</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Adults</th>
                <th>Children</th>
                <th>Action</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['booking_id']; ?></td>
                <td><?php echo htmlspecialchars($row['room_type']); ?></td>
                <td><?php echo htmlspecialchars($row['check_in_date']); ?></td>
                <td><?php echo htmlspecialchars($row['check_out_date']); ?></td>
                <td><?php echo $row['adults']; ?></td>
                <td><?php echo $row['children']; ?></td>
               <td>
    <!-- View Button -->
    <a href="checkout_summary.php?booking_id=<?php echo $row['booking_id']; ?>" 
       class="btn_cancel" style="background:#5bc0de; margin-right:10px;">View</a>
<br><br>
    <!-- Cancel Button -->
    <form method="POST" action="cancel_booking.php" style="display:inline;" 
          onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
        <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
        <button type="submit" class="btn_cancel">Cancel</button>
    </form>
</td>

            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align:center; margin-top:40px;">You have no reservations.</p>
    <?php endif; ?>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
