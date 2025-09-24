<?php
include 'db.php';
$id = $_GET['id'];
$movie = $conn->query("SELECT * FROM movies WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $desc = $_POST['description'];
  $genre = $_POST['genre'];
  $release = $_POST['release_date'];
  $poster = $_POST['poster_url'];
  $trailer = $_POST['trailer_url'];

  $stmt = $conn->prepare("UPDATE movies SET title=?, description=?,  release_date=?, poster=?, trailer_link=? WHERE id=?");
  $stmt->bind_param("sssssi", $title, $desc, $release, $poster, $trailer, $id);
  $stmt->execute();
  header("Location: manage_movies.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Movie</title>
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<div class="admin-container">
  <h2>✏️ Edit Movie</h2>
  <form method="POST">
    <input type="text" name="title" value="<?= htmlspecialchars($movie['title']) ?>" required>
    <input type="text" name="genre" value="<?= htmlspecialchars($movie['description']) ?>">
    <input type="date" name="release_date" value="<?= $movie['release_date'] ?>" required>
    <input type="text" name="poster_url" value="<?= $movie['poster'] ?>">
    <input type="text" name="trailer_url" value="<?= $movie['trailer_link'] ?>">
    <textarea name="description" rows="4"><?= htmlspecialchars($movie['description']) ?></textarea>
    <button type="submit" class="btn">Update Movie</button>
  </form>
</div>
</body>
</html>
