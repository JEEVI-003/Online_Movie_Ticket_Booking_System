<?php
session_start();
$userLoggedIn = isset($_SESSION['user_name']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MovieVerse - Book Your Show</title>
    <link rel="stylesheet" href="css/styles.css" />
    <style></style>
  </head>
  <body>
    <nav class="navbar">
      <div class="logo">🎬 Jeevi Cinemas</div>
      <ul class="nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="movie.php">Movies</a></li>
        <li><a href="mybookings.php">Bookings</a></li>
        <?php if ($userLoggedIn): ?>
        <li class="user-dropdown">
          <button class="user-dropdown-toggle">
            <?= htmlspecialchars($_SESSION['user_name']) ?>
            ⬇
          </button>
          <div class="user-menu">
            <!-- <a href="#">Profile</a> -->
            <a href="logout.php">Logout</a>
          </div>
        </li>
        <?php else: ?>
        <li><a href="login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </nav>

    <header class="hero">
      <div class="hero-text">
        <h1>Book Tickets for the Latest Blockbusters</h1>
        <p>
          Experience movies like never before. Fast, easy, and secure booking.
        </p>
        <a href="movie.php" class="btn">Browse Movies</a>
      </div>
    </header>
  </body>
</html>
