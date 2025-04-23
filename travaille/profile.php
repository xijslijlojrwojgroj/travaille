<?php
session_start();
require 'db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$current_user_id = $_SESSION["user_id"];
$view_user_id = isset($_GET['id']) ? intval($_GET['id']) : $current_user_id;

$query = $conn->prepare("SELECT * FROM users WHERE id = ?");
$query->bind_param("i", $view_user_id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

$is_own_profile = ($current_user_id == $view_user_id);
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $is_own_profile ? "Your" : $user['name'] . "'s"; ?> Profile</title>
  <link href="styles.css" rel="stylesheet">
  <style>
    .profile-card {
      background: #f3e8ff;
      padding: 30px;
      border-radius: 15px;
      max-width: 600px;
      margin: 40px auto;
      font-family: 'Pixelify Sans', sans-serif;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
    }
    .profile-pic {
      width: 150px;
      height: 150px;
      border-radius: 100px;
      object-fit: cover;
      display: block;
      margin: 0 auto 20px;
    }
    .profile-section {
      margin: 15px 0;
    }
    .profile-section label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
      color: #555;
    }
    .profile-section p {
      background: #fff;
      padding: 10px;
      border-radius: 8px;
      color: #333;
    }
    input, textarea, select, button {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 8px;
      border: 1px solid #ccc;
      margin-bottom: 15px;
    }
    button {
      background-color: #454163;
      color: white;
      font-size: 18px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<div class="profile-card">
  <img src="uploads/<?php echo $user['profile_pic'] ?: 'default.png'; ?>" class="profile-pic">
  <h2><?php echo htmlspecialchars($user['name'] ?? 'User'); ?>'s Profile</h2>


  <?php if ($user['privacy_settings'] === 'private' && !$is_own_profile): ?>
    <p style="text-align:center;">This profile is private.</p>
  <?php else: ?>
    <?php if ($is_own_profile): ?>
      <form method="POST" action="save_profile.php" enctype="multipart/form-data">
        <div class="profile-section">
          <label>Change Profile Picture</label>
          <!-- Preview the selected image -->
<img id="preview" src="uploads/<?php echo $user['profile_pic'] ?: 'default.png'; ?>" class="profile-pic" style="margin-bottom: 15px;" />

<!-- File input -->
<input type="file" name="profile_pic" accept="image/*" onchange="previewImage(event)">

        </div>
        <div class="profile-section">
          <label>Travel Interests</label>
          <input type="text" name="interests" value="<?php echo htmlspecialchars($user['interests'] ?? ''); ?>">
        </div>
        <div class="profile-section">
          <label>Bio</label>
          <textarea name="bio"><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>
        </div>
        <div class="profile-section">
          <label>Preferred Destinations</label>
          <input type="text" name="preferred_destinations" value="<?php echo htmlspecialchars($user['preferred_destinations'] ?? ''); ?>">
        </div>
        <div class="profile-section">
          <label>Privacy Settings</label>
          <select name="privacy_settings">
            <option value="public" <?php echo $user['privacy_settings'] === 'public' ? 'selected' : ''; ?>>Public</option>
            <option value="private" <?php echo $user['privacy_settings'] === 'private' ? 'selected' : ''; ?>>Private</option>
          </select>
        </div>
        <button type="submit">Save Profile</button>
      </form>
    <?php else: ?>
      <div class="profile-section"><label>Bio</label><p><?php echo htmlspecialchars($user['bio'] ?? 'N/A'); ?></p></div>
      <div class="profile-section"><label>Travel Interests</label><p><?php echo htmlspecialchars($user['interests'] ?? 'N/A'); ?></p></div>
      <div class="profile-section"><label>Preferred Destinations</label><p><?php echo htmlspecialchars($user['preferred_destinations'] ?? 'N/A'); ?></p></div>
    <?php endif; ?>
  <?php endif; ?>
</div>

</body>
<script>
function previewImage(event) {
  const reader = new FileReader();
  reader.onload = function() {
    document.getElementById('preview').src = reader.result;
  };
  reader.readAsDataURL(event.target.files[0]);
}
</script>

</html>
