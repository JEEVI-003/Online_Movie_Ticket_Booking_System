<?php
include 'db.php';

$id = $_GET['id'];

// Delete the booking
$stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: manage_bookings.php");
exit;
?>
