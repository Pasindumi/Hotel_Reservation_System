<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<style>
.navbar_a:hover {
    color: white;
    opacity: 0.5;
}
</style>

<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-brand">
            <a class="navbar_a" href="index.php">Grand Elegance</a> 
        </div>
        <div class="navbar-contents">
            <div class="navbar_home navbar-element">
                <a class="navbar_a" href="index.php">HOME</a>
            </div>
            <div class="navbar_about navbar-element">
                <a class="navbar_a" href="aboutus.php">ABOUT</a>
            </div>
            <div class="navbar_rooms navbar-element">
                <a class="navbar_a" href="#rooms-nav">ROOMS</a>
            </div>
            <div class="navbar_services navbar-element">
                <a class="navbar_a" href="#services-nav">SERVICES</a>
            </div>
            <div class="navbar_gallery navbar-element">
                <a class="navbar_a" href="#gallery-nav">GALLERY</a>
            </div>
            <div class="navbar_reviews navbar-element">
                <a class="navbar_a" href="checkout_summary.php?booking_id=<?php echo $row['booking_id']; ?>">Bookings</a>
            </div>
            <div class="navbar_contact navbar-element">
                <a class="navbar_a" href="#contact-nav">CONTACT</a>
            </div>
            <div class="navbar_bookaroom navbar-element">
                <a class="navbar_a" href="../../book_page2.html">Book A Room</a>
            </div>

            <?php if(isset($_SESSION['username'])): ?>
                <div class="navbar_welcome navbar-element">
                    <span style="color:white; font-weight:bold;">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                </div>
                 <div class="navbar_cancel navbar-element">
        <a class="navbar_a" href="cancel_reservations.php">Cancel Reservation</a>
    </div>
                <div class="navbar_logout navbar-element">
                    <a class="navbar_a" href="logout.php">Logout</a>
                </div>
            <?php else: ?>
                <div class="navbar_login navbar-element">
                    <a class="navbar_a" href="../../login.html">Login</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>
