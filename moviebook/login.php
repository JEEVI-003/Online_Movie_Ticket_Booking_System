<?php
include 'db.php';
session_start();

$loginError = "";
$registerError = "";
$registerSuccess = "";
$loginSuccess = "";
$redirectToIndex = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
      $user = $result->fetch_assoc();
      if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $loginSuccess = "Login successful! Redirecting to home...";
        $redirectToIndex = true;
      } else {
        $loginError = "Incorrect password!";
      }
    } else {
      $loginError = "User not found!";
    }
  }

  if (isset($_POST['register'])) {
    $name = trim($_POST['reg_name']);
    $phone = trim($_POST['reg_phone']);
    $reg_email = trim($_POST['reg_email']);
    $reg_password = $_POST['reg_password'];
    $hashed_password = password_hash($reg_password, PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $reg_email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
      $registerError = "Email already registered!";
    } else {
      $stmt = $conn->prepare("INSERT INTO users (name, phone, email, password) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("ssss", $name, $phone, $reg_email, $hashed_password);
      if ($stmt->execute()) {
        $last_id = $stmt->insert_id;
        $_SESSION['user_id'] = $last_id;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $reg_email;
        $registerSuccess = "Registration successful! Redirecting to home...";
        $redirectToIndex = true;
      } else {
        $registerError = "Registration failed. Try again.";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login/Register - MovieVerse</title>
  <link rel="stylesheet" href="css/login.css" />
  <style>.hidden { display: none; }</style>
</head>
<body>
  <div class="login-container">

    <!-- Login Form -->
    <form method="POST" class="login-form" id="loginForm" <?= $loginSuccess ? 'style="display:block;"' : '' ?>>
      <h2>Login to Jeevi Cinemas</h2>
      <?php if ($loginError): ?>
        <p class="error-msg"><?= $loginError ?></p>
      <?php elseif ($loginSuccess): ?>
        <p class="success-msg"><?= $loginSuccess ?></p>
      <?php endif; ?>
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit" name="login" class="btn">Login</button>
      <p class="info-text">Don't have an account? <a href="#" onclick="toggleForms()">Register</a></p>
    </form>

    <!-- Register Form -->
    <form method="POST" class="login-form <?= $registerError || $registerSuccess ? '' : 'hidden' ?>" id="registerForm">
      <h2>Register on Jeevi Cinemas</h2>
      <?php if ($registerError): ?>
        <p class="error-msg"><?= $registerError ?></p>
      <?php elseif ($registerSuccess): ?>
        <p class="success-msg"><?= $registerSuccess ?></p>
      <?php endif; ?>
      <input type="text" name="reg_name" placeholder="Full Name" required />
      <input type="text" name="reg_phone" placeholder="Phone Number" required />
      <input type="email" name="reg_email" placeholder="Email" required />
      <input type="password" name="reg_password" placeholder="Password" required />
      <button type="submit" name="register" class="btn">Register</button>
      <p class="info-text">Already have an account? <a href="#" onclick="toggleForms()">Login</a></p>
    </form>

  </div>

  <script>
    function toggleForms() {
      document.getElementById('loginForm').classList.toggle('hidden');
      document.getElementById('registerForm').classList.toggle('hidden');
    }

    <?php if ($redirectToIndex): ?>
      setTimeout(() => {
        window.location.href = "index.php";
      }, 2000);
    <?php endif; ?>
  </script>
</body>
</html>
