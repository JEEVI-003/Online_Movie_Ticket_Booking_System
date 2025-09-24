<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];

$sql = "SELECT movie_title, seat_no FROM bookings WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Bookings - Jeevi Cinemas</title>
  <link rel="stylesheet" href="css/mybookings.css" />
</head>
<body>
  <div class="container">
    <h2>🎟️ <?= htmlspecialchars($name) ?>'s Bookings</h2>
    <?php if (isset($_SESSION['cancel_success'])): ?>
  <div class="success-msg"><?= $_SESSION['cancel_success'] ?></div>
  <?php unset($_SESSION['cancel_success']); ?>
  <?php endif; ?>

    <?php if (empty($bookings)): ?>
      <p>No bookings yet. <a href="movies.php">Browse Movies</a></p>
    <?php else: ?>
      <div class="bookings-grid">
        <?php foreach ($bookings as $b): ?>
          <div class="booking-card">
  <h3><?= htmlspecialchars($b['movie_title']) ?></h3>
  <p><strong>Seat:</strong> <?= $b['seat_no'] ?></p>
  <!-- <p><strong>Date:</strong> <?= date("d M Y, h:i A", strtotime($b['booked_at'])) ?></p> -->
  <form method="POST" action="cancel_booking.php" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
    <input type="hidden" name="movie_title" value="<?= htmlspecialchars($b['movie_title']) ?>">
    <input type="hidden" name="seat_no" value="<?= htmlspecialchars($b['seat_no']) ?>">
    <button type="submit" class="cancel-btn">Cancel Booking</button>
  </form>
</div>

        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
