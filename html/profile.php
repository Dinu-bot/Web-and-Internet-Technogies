<?php
session_start();
require_once '../db/db_connect.php';

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login_register_logout.php");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Fetch more user details if needed
$stmt = $conn->prepare("SELECT email FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Profile</title>
  <link rel="stylesheet" href="../css/vet_app.css">
  <style>
    .profile-container {
      max-width: 600px;
      margin: 80px auto;
      padding: 40px;
      border: 4px solid #2b6777;
      border-radius: 15px;
      background-color: #ffffff;
      text-align: center;
      box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }

    .profile-container h2 {
      color: #2b6777;
      margin-bottom: 20px;
    }

    .profile-container p {
      font-size: 1.2em;
      margin: 10px 0;
    }

    .profile-container a {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #2b6777;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
    }

    .profile-container a:hover {
      background-color: #3d7d91;
    }
  </style>
</head>
<body>
  <div class="profile-container">
    <h2>Welcome, <?= htmlspecialchars($username) ?></h2>
    <p><strong>Role:</strong> <?= htmlspecialchars($role) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>

    <a href="main.php">Back to Dashboard</a>
  </div>
</body>
</html>
