<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Jeevi Cinemas</title>
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<?php include 'admin_nav.php'; ?>
  <div class="admin-container">
    <h1>🎬 Admin Dashboard</h1>
    <div class="cards">
      <a href="manage_users.php" class="card">👥 Manage Users</a>
      <a href="manage_movies.php" class="card">🎞️ Manage Movies</a>
      <a href="manage_bookings.php" class="card">📅 Manage Bookings</a>
    </div>
  </div>
</body>
</html>
