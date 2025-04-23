<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

require 'db.php';

$user_id = $_SESSION["user_id"];
$result = $conn->query("SELECT * FROM users WHERE id = $user_id");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - Travaille</title>
  <link href="styles.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
  <div class="logo">TRAVAILLE</div>
  <ul class="navbar-list">
    <li><a href="dashboard.php">HOME</a></li>
    <li><a href="discover.html">DISCOVERY</a></li>
    <li><a href="#">NETWORK</a></li>
    <li class="profile-icon">
      <a href="profile.php" title="Your Profile">
        <i class="fas fa-user-circle"></i>
      </a>
    </li>
    <li>
      <a href="logout.php"><button>LOGOUT</button></a>
    </li>
  </ul>
</nav>


<!-- HERO SECTION -->
<section style="text-align: center; margin-top: 40px;">
  <h1 style="font-size: 36px; color: #454163;">Hello, <?php echo htmlspecialchars($user['username']); ?></h1>
</section>

<!-- LOGO -->
<div id="logo">
  <img src="logo/thelogo.png" />
</div>

<!-- SEARCH BAR -->
<div class="searchbar">
  <input type="text" id="search-input" placeholder="Where are you traveling to?" />
  <button id="search-button">SEARCH</button>
</div>

<!-- HOW IT WORKS -->
<div class="how-it-works">
  <h1>HOW TRAVAILLE WORKS?</h1>
  <div class="info-all">
    <div class="box">
      <h2>SEARCH DESTINATION</h2>
      <p>Search and select a destination that you are traveling to.</p>
    </div>
    <div class="box">
      <h2>DISCOVERY</h2>
      <p>Easily discover nearby hotels and restaurants with categorized listings, making it simple to find the best spots around you.</p>
    </div>
    <div class="box">
      <h2>GET CONNECTED</h2>
      <p>When you find someone that you want to meet up with, click the connect button and start chatting with them.</p>
    </div>
    <div class="box">
      <h2>SAFETY & VERIFICATION</h2>
      <p>Stay secure with profile verification, privacy controls, and reviews.</p>
    </div>
  </div>
</div>

<script src="script.js"></script>
</body>
</html>
