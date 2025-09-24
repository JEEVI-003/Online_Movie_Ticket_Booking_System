<?php
include 'db.php';
$result = $conn->query("SELECT * FROM movies");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Movies</title>
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <?php include 'admin_nav.php'; ?>
  <div class="admin-container">
    <h1>🎞️ Manage Movies</h1>
    <a href="add_movie.php" class="btn">➕ Add New Movie</a>
    <table>
      <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Release Date</th>
        <th>Actions</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['title']) ?></td>
          <td><?= htmlspecialchars($row['description']) ?></td>
          <td><?= $row['release_date'] ?></td>
          <td>
            <a href="edit_movie.php?id=<?= $row['id'] ?>">✏️ Edit</a> |
            <a href="delete_movie.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">🗑️ Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
</body>
</html>
