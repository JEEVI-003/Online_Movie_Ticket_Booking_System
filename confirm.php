<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['last_booking'])) {
    header("Location: index.php");
    exit;
}

$booking = $_SESSION['last_booking'];
$user_name = $_SESSION['user_name']; 
$movie = $booking['movie'];
$seats = $booking['seats'];
$total_price = count($seats) * 150;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Booking Confirmation</title>
  <link rel="stylesheet" href="css/confirm.css" />
</head>
<body>
  <div class="confirm-container">
    <h2>🎉 Booking Confirmed!</h2>
    <p><strong>User:</strong> <?= htmlspecialchars($user_name) ?></p>
    <p><strong>Movie:</strong> <?= htmlspecialchars($movie) ?></p>
    <p><strong>Seats:</strong> <?= implode(', ', $seats) ?></p>
    <p><strong>Total:</strong> ₹<?= $total_price ?></p>

    <h3>Select Payment Option</h3>
    <div class="payment-options">
      <button onclick="processPayment('Credit Card')">💳 Credit Card</button>
      <button onclick="processPayment('UPI')">📱 UPI</button>
      <button onclick="processPayment('Net Banking')">🏦 Net Banking</button>
      <button onclick="processPayment('Pay at Counter')">💵 Pay at Counter</button>
    </div>
  </div>

  <!-- Payment Modal -->
  <div id="paymentModal" class="modal">
    <div class="modal-content">
      <span id="paymentText">Processing payment...</span>
    </div>
  </div>

  <script>
    function processPayment(method) {
      const modal = document.getElementById('paymentModal');
      const text = document.getElementById('paymentText');
      modal.style.display = 'flex';
      text.textContent = `Processing payment via ${method}...`;

      setTimeout(() => {
        text.textContent = `✅ Payment Successful via ${method}! Redirecting...`;
        setTimeout(() => {
          window.location.href = "index.php";
        }, 2000);
      }, 2000);
    }
  </script>
</body>
</html>
<?php
    unset($_SESSION['last_booking']);
?>