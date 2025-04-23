<?php
session_start();
require 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION["user_id"] = $user["id"];
    header("Location: dashboard.php");
    exit();
  } else {
    $error = "Invalid email or password.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="styles.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" rel="stylesheet">
  <style>
    .auth-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: 'Pixelify Sans', sans-serif;
    }
    .auth-box {
      background-color: #DBC2F1;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }
    .auth-box h1 {
      font-size: 32px;
      margin-bottom: 25px;
      color: #454163;
    }
    .auth-box input,
    .auth-box button {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: none;
      font-size: 18px;
      font-family: 'Pixelify Sans', sans-serif;
    }
    .auth-box input {
      background: #eee;
    }
    .auth-box button {
      background: #454163;
      color: white;
      cursor: pointer;
      transition: 0.3s ease;
    }
    .auth-box button:hover {
      background: #33304a;
    }
    .auth-box p {
      margin-top: 10px;
      color: #454163;
    }
    .error-msg {
      color: red;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="auth-container">
    <div class="auth-box">
      <h1>Login to Travaille</h1>

      <?php if ($error): ?>
        <div class="error-msg"><?php echo $error; ?></div>
      <?php endif; ?>

      <form method="POST" action="">
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
      </form>

      <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
  </div>
</body>
</html>
