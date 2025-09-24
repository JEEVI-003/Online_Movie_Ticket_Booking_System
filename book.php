<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$movie = isset($_GET['movie']) ? $_GET['movie'] : 'Unknown Movie';

$bookedSeats = [];
$sql = "SELECT seat_no FROM bookings WHERE movie_title = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $movie);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $bookedSeats[] = $row['seat_no'];
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedSeats = $_POST['seats'] ?? [];
    $user_id = $_SESSION['user_id'];
    $movie_title = $_POST['movie_title'];

    foreach ($selectedSeats as $seat) {
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, movie_title, seat_no) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $movie_title, $seat);
        $stmt->execute();
    }

    $_SESSION['last_booking'] = [
    'movie' => $movie_title,
    'seats' => $selectedSeats
    ];
    header("refresh:3;url=confirm.php");
    $message = "🎉 Booking successful! Redirecting to confirmation...";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Book Tickets - <?= htmlspecialchars($movie) ?></title>
  <link rel="stylesheet" href="css/book.css">
</head>
<body>

  <h2>Book Seats for <span style="color:#fff;"><?= htmlspecialchars($movie) ?></span></h2>

  <?php if ($message): ?>
    <div class="message"><?= $message ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <div class="seat-container">
      <?php
        $rows = ['A','B','C','D','E'];
        for ($i = 0; $i < 5; $i++) {
            for ($j = 1; $j <= 10; $j++) {
                $seatID = $rows[$i] . $j;
                $isBooked = in_array($seatID, $bookedSeats);
                echo "
                    <div class='seat " . ($isBooked ? "booked" : "") . "'>
                    <input type='checkbox' name='seats[]' value='$seatID' id='$seatID' " . ($isBooked ? "disabled" : "") . ">
                    <label for='$seatID'>$seatID</label>
                    </div>
                ";
            }
        }
      ?>
    </div>
    <input type="hidden" name="movie_title" value="<?= htmlspecialchars($movie) ?>">
    <button type="submit" class="btn">Confirm Booking</button>
  </form>

</body>
</html>
