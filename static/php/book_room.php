<?php
// Get room info from POST
$room_id = $_POST['room_id'] ?? '';
$room_name = $_POST['room_name'] ?? '';
$room_size = $_POST['room_size'] ?? '';
$room_bed = $_POST['room_bed'] ?? '';
$price = $_POST['price'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Booking</title>
    <style>
        /* Basic Reset */
        body, html { margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; height: 100%; background: url("static/images/background.jpg") no-repeat center center fixed; background-size: cover; }

        /* Overlay for readability */
        body::before { content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.45); z-index: -1; }

        /* Main Title */
        .text_reserv { text-align: center; margin: 40px auto 20px auto; width: fit-content; background: rgba(0,0,0,0.6); padding: 15px 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.4); animation: fadeDown 1.2s ease-in-out; }
        .heading_reserv { font-weight: 900; font-size: 220%; color: #fff; letter-spacing: 2px; }

        /* Main form wrapper */
        .form-container { max-width: 1100px; margin: 0 auto; background: rgba(255,255,255,0.95); border-radius: 20px; box-shadow: 0px 8px 30px rgba(0,0,0,0.35); overflow: hidden; animation: fadeUp 1.2s ease-in-out; }

        .main-section { display: flex; justify-content: space-between; gap: 40px; padding: 40px; position: relative; }

        /* Vertical divider line */
        .main-section::after { content: ""; position: absolute; top: 30px; bottom: 30px; left: 50%; width: 2px; background: #ccc; }

        .form-left, .form-right { width: 48%; }

        label { font-size: 15px; font-weight: 600; display: block; margin-bottom: 5px; color: #444; }
        input, select, textarea { padding: 12px; width: 100%; border-radius: 8px; border: 1px solid #ccc; margin-bottom: 18px; font-size: 14px; transition: 0.3s; }
        input:focus, select:focus, textarea:focus { outline: none; border-color: #a87c4f; box-shadow: 0px 0px 8px rgba(168,124,79,0.5); }

        /* Room info box */
        .room-info { background: rgba(0,0,0,0.1); padding: 15px; border-radius: 10px; margin-bottom: 25px; color: #222; }
        .room-info h3 { margin-bottom: 8px; }
        .room-info p { margin: 4px 0; font-size: 14px; }

        /* Checkout Button */
        .checkout-row { text-align: center; padding: 20px 0 40px 0; background: #fff; border-top: 1px solid #ddd; }
        .btn { background: linear-gradient(135deg, #d4a373, #a87c4f); color: white; font-size: 16px; font-weight: bold; padding: 12px 35px; border: none; border-radius: 30px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0px 5px 15px rgba(0,0,0,0.2); }
        .btn:hover { transform: scale(1.05); background: linear-gradient(135deg, #a87c4f, #d4a373); box-shadow: 0px 8px 20px rgba(0,0,0,0.3); }

        /* Animations */
        @keyframes fadeUp { from { opacity: 0; transform: translateY(50px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeDown { from { opacity: 0; transform: translateY(-40px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>
    <!-- Main Title -->
    <div class="text_reserv">
        <div class="heading_reserv">MAKE YOUR RESERVATION</div>
    </div>

    <!-- Room Info -->
    <div class="form-container">
        <div class="room-info">
            <h3>Room Selected: <?= htmlspecialchars($room_name) ?></h3>
            <p>Size: <?= htmlspecialchars($room_size) ?></p>
            <p>Beds: <?= htmlspecialchars($room_bed) ?></p>
            <p>Price: ₹ <?= htmlspecialchars($price) ?></p>
        </div>

        <!-- Form -->
        <form method="POST" action="store_booking.php" class="main-section">
            <!-- Hidden room details -->
            <input type="hidden" name="room_id" value="<?= htmlspecialchars($room_id) ?>">
            <input type="hidden" name="room_name" value="<?= htmlspecialchars($room_name) ?>">
            <input type="hidden" name="room_size" value="<?= htmlspecialchars($room_size) ?>">
            <input type="hidden" name="room_bed" value="<?= htmlspecialchars($room_bed) ?>">
            <input type="hidden" name="price" value="<?= htmlspecialchars($price) ?>">

            <!-- Left Side: Stay Details -->
            <div class="form-left">
                <label for="check-in">Check In</label>
                <input type="text" id="check-in" placeholder="DD/MM/YYYY" onfocus="(this.type='date')" required name="check_in_date">

                <label for="check-out">Check Out</label>
                <input type="text" id="check-out" placeholder="DD/MM/YYYY" onfocus="(this.type='date')" required name="check_out_date">

                <label for="rooms">Rooms</label>
                <input type="number" id="rooms" name="rooms" placeholder="Rooms" min="1" required>

                <label for="adults">Adults</label>
                <input type="number" id="adults" name="adults" placeholder="Adults" min="1" required>

                <label for="children">Children</label>
                <input type="number" id="children" name="children" placeholder="Children" min="0" required>
            </div>

            <!-- Right Side: Guest Details -->
            <div class="form-right">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="first_name" required>

                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="last_name" required>

                <label for="phno">Phone</label>
                <input type="text" id="phno" name="phone" required>

                <label for="guest_email">Email</label>
                <input type="email" id="guest_email" name="email" required>

                <label for="country">Country</label>
                <select id="country" name="country">
                    <option value="India" selected>India</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="USA">USA</option>
                    <option value="UK">United Kingdom</option>
                    <option value="Australia">Australia</option>
                </select>

                <label for="reqs">Special Requests</label>
                <textarea id="reqs" name="requests" rows="3"></textarea>
            </div>

            <!-- Checkout Button -->
            <div class="checkout-row">
                <button type="submit" class="btn">Check-out</button>
            </div>
        </form>
    </div>
</body>
</html>
