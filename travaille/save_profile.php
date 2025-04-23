<?php
session_start();
require 'db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$current = $conn->query("SELECT profile_pic FROM users WHERE id = $user_id")->fetch_assoc();
$current_pic = $current['profile_pic'] ?? null;

if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
    $file_tmp = $_FILES['profile_pic']['tmp_name'];
    $file_name = uniqid() . "_" . basename($_FILES['profile_pic']['name']);
    $target_path = "uploads/" . $file_name;
    move_uploaded_file($file_tmp, $target_path);
    $profile_pic = $file_name;
} else {
    $profile_pic = $current_pic;
}

$bio = $conn->real_escape_string($_POST['bio'] ?? '');
$interests = $conn->real_escape_string($_POST['interests'] ?? '');
$destinations = $conn->real_escape_string($_POST['preferred_destinations'] ?? '');
$privacy = in_array($_POST['privacy_settings'], ['public', 'private']) ? $_POST['privacy_settings'] : 'public';

$stmt = $conn->prepare("UPDATE users SET profile_pic = ?, bio = ?, interests = ?, preferred_destinations = ?, privacy_settings = ? WHERE id = ?");
$stmt->bind_param("sssssi", $profile_pic, $bio, $interests, $destinations, $privacy, $user_id);
$stmt->execute();

header("Location: profile.php");
exit();
