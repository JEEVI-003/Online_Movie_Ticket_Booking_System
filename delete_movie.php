<?php
include 'db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM movies WHERE id=$id");
header("Location: manage_movies.php");
exit;
?>
