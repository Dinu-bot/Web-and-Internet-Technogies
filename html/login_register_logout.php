<?php
session_start();
require_once '../db/db_connect.php';

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login_register_logout.php");
    exit();
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = hash("sha256", $_POST["password"]);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: login_register_logout.php");
        exit();
    } else {
        $error = "Invalid credentials!";
    }
}

// Handle pet registration if customer
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_pet']) && isset($_SESSION['role']) && $_SESSION['role'] === 'customer') {
    $owner_name = $_POST["owner-name"];
    $email = $_POST["email"];
    $pet_name = $_POST["pet-name"];
    $pet_type = $_POST["pet-type"];
    $breed = $_POST["breed"];
    $age = $_POST["age"];
    $notes = $_POST["notes"];

    $stmt = $conn->prepare("INSERT INTO pets (owner_name, email, pet_name, pet_type, breed, age, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssis", $owner_name, $email, $pet_name, $pet_type, $breed, $age, $notes);
    
    if ($stmt->execute()) {
        $msg = "Pet registered successfully!";
    } else {
        $msg = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login / Register</title>
  <link rel="stylesheet" href="../css/vet_app.css">
  <style>
    .login-container {
      max-width: 600px;
      margin: 60px auto;
      padding: 40px;
      border: 4px solid #2b6777;
      background-color: #ffffff;
      border-radius: 15px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }

    h1, h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #2b6777;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    .form-group {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 6px;
      text-align: center;
    }

    input[type="text"],
    input[type="password"],
    input[type="number"],
    textarea,
    select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
    }

    .password-input {
      width: 80%;
      margin: 0 auto;
    }

    input[type="submit"], .button-link {
      margin-top: 20px;
      padding: 10px;
      background-color: #2b6777;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      text-align: center;
      text-decoration: none;
      display: inline-block;
    }

    input[type="submit"]:hover,
    .button-link:hover {
      background-color: #256d47;
    }

    .success-msg {
      color: green;
      font-weight: bold;
      text-align: center;
    }

    .error-msg {
      color: red;
      font-weight: bold;
      text-align: center;
    }

    .center-links {
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <?php if (!isset($_SESSION['role'])): ?>
      <h1>Login</h1>
      <?php if (isset($error)) echo "<p class='error-msg'>$error</p>"; ?>
      <form method="post">
        <input type="hidden" name="login" value="1">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" name="username" id="username" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" class="password-input" required>
        </div>
        <input type="submit" value="Login">
      </form>
      <p style="text-align:center; margin-top:15px;">Don't have an account?</p>
      <div class="center-links">
        <a href="register_user.php" class="button-link">Register</a>
      </div>

    <?php elseif ($_SESSION['role'] === 'doctor'): ?>
      <h2>Welcome, Dr. <?= htmlspecialchars($_SESSION['username']) ?></h2>
      <div class="center-links">
        <a href="main.php" class="button-link">Go to Main Dashboard</a><br><br>
        <a href="?logout=1" class="button-link">Logout</a>
      </div>

    <?php elseif ($_SESSION['role'] === 'customer'): ?>
      
      <h2>Welcome,  <?= htmlspecialchars($_SESSION['username']) ?></h2>
      <div class="center-links">
        <a href="main.php" class="button-link">Go to Main Dashboard</a><br><br>
        <a href="?logout=1" class="button-link">Logout</a>
      </div>
      
    <?php endif; ?>
  </div>
</body>
</html>
