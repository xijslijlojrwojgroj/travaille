<?php
session_start();
require 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
  $check->bind_param("s", $email);
  $check->execute();
  $check->store_result();

  if ($check->num_rows > 0) {
    $error = "Email already registered.";
  } else {
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) {
      $_SESSION["user_id"] = $stmt->insert_id;
      header("Location: dashboard.php");
      exit();
    } else {
      $error = "Registration failed.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
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
      <h1>Create Your Account</h1>

      <?php if ($error): ?>
        <div class="error-msg"><?php echo $error; ?></div>
      <?php endif; ?>

      <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required />
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Register</button>
      </form>

      <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
  </div>
</body>
</html>
