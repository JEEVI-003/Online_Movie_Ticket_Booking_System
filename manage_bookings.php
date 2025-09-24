<?php
include 'db.php';

// Join users to get user names
$sql = "SELECT b.id, u.name AS user_name, b.movie_title, b.seat_no, b.booking_time 
        FROM bookings b 
        JOIN users u ON b.user_id = u.id
        ORDER BY b.booking_time DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Bookings</title>
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <?php include 'admin_nav.php'; ?>
<div class="admin-container">
  <h1>🎟️ Manage Bookings</h1>
  <table>
    <tr>
      <th>ID</th>
      <th>User</th>
      <th>Movie</th>
      <th>Seat No</th>
      <th>Booked At</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= htmlspecialchars($row['user_name']) ?></td>
      <td><?= htmlspecialchars($row['movie_title']) ?></td>
      <td><?= $row['seat_no'] ?></td>
      <td><?= $row['booking_time'] ?></td>
      <td>
        <a href="delete_booking.php?id=<?= $row['id'] ?>" onclick="return confirm('Cancel this booking?')">❌ Cancel</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>
</body>
</html>
