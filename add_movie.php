<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $desc = $_POST['description'];
  $release = $_POST['release_date'];
  $poster = $_POST['poster_url'];
  $trailer = $_POST['trailer_url'];

  $stmt = $conn->prepare("INSERT INTO movies (title, description, release_date, poster, trailer_link) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $title, $desc, $release, $poster, $trailer);
  $stmt->execute();
  header("Location: manage_movies.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Movie</title>
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<?php include 'admin_nav.php'; ?>
<div class="admin-container">
  <h2>➕ Add New Movie</h2>
  <form method="POST">
    <input type="text" name="title" placeholder="Title" required>
    <input type="date" name="release_date" required>
    <input type="text" name="poster_url" placeholder="Poster URL">
    <input type="text" name="trailer_url" placeholder="Trailer URL">
    <textarea name="description" placeholder="Description" rows="4"></textarea>
    <button type="submit" class="btn">Add Movie</button>
  </form>
</div>
</body>
</html>
