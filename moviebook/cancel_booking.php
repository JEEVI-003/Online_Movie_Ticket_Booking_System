<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'];
    $movie_title = $_POST['movie_title'];
    $seat_no = $_POST['seat_no'];

    $stmt = $conn->prepare("DELETE FROM bookings WHERE user_id = ? AND movie_title = ? AND seat_no = ?");
    $stmt->bind_param("iss", $user_id, $movie_title, $seat_no);
    $stmt->execute();

    // Redirect back with a success message
    $_SESSION['cancel_success'] = "Booking for $movie_title (Seat $seat_no) has been canceled.";
    header("Location: mybookings.php");
    exit;
}
?>
