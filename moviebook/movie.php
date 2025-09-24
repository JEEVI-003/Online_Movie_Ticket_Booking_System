<?php
session_start();
include 'db.php';

$sql = "SELECT * FROM movies";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Now Showing - Jeevi Cinemas</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/movie.css">
</head>
<body>

  <nav class="navbar">
    <div class="logo">🎬 Jeevi Cinemas</div>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="movie.php">Movies</a></li>
      <li><a href="mybookings.php">Bookings</a></li>
      <?php if (isset($_SESSION['user_name'])): ?>
        <li class="user-dropdown">
          <button class="user-dropdown-toggle"><?= htmlspecialchars($_SESSION['user_name']) ?> ⬇</button>
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

  <main>
    <section class="movies-container">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="movie-card">
            <img src="<?= htmlspecialchars($row['poster']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="movie-poster">
            <div class="movie-content">
              <h3><?= htmlspecialchars($row['title']) ?></h3>
              <p><?= htmlspecialchars($row['description']) ?></p>
              <div class="btn-group">
                <a href="book.php?movie=<?= urlencode($row['title']) ?>" class="btn">Book Now</a>
                <a href="<?= htmlspecialchars($row['trailer_link']) ?>" target="_blank" class="btn">Watch Trailer</a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p style="color: #fff; text-align: center;">No movies available.</p>
      <?php endif; ?>
    </section>
  </main>

</body>
</html>
