<?php
include 'db.php';

$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

echo "Admin created!";
?>
