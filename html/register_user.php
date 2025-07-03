<?php
require_once '../db/db_connect.php';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = hash("sha256", $_POST["password"]);
    $role = $_POST["role"];

    // Check if username already exists
    $check = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $error = "Username already taken!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $password, $role);

        if ($stmt->execute()) {
            $success = "Registration successful! You can now <a href='login_register_logout.php'>Login</a>";
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register User</title>
  <link rel="stylesheet" href="../css/vet_app.css">
  <style>
    .register-container {
      max-width: 500px;
      margin: 60px auto;
      padding: 40px;
      border: 4px solid #2b6777;
      background-color: #ffffff;
      border-radius: 15px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }

    h2 {
      text-align: center;
      color: #2b6777;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-top: 15px;
      font-weight: bold;
      text-align: center;
    }

    input, select {
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      width: 100%;
      box-sizing: border-box;
    }

    input[type="submit"] {
      margin-top: 20px;
      background-color: #2b6777;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #256d47;
    }

    .success-msg {
      color: green;
      font-weight: bold;
      text-align: center;
      margin-top: 10px;
    }

    .error-msg {
      color: red;
      font-weight: bold;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <h2>User Registration</h2>

    <?php if ($success): ?>
      <p class="success-msg"><?= $success ?></p>
    <?php elseif ($error): ?>
      <p class="error-msg"><?= $error ?></p>
    <?php endif; ?>

    <form method="post">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required>

      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>

      <label for="role">Select Role:</label>
      <select name="role" id="role" required>
        <option value="">-- Select --</option>
        <option value="doctor">Doctor</option>
        <option value="customer">Customer</option>
      </select>

      <input type="submit" value="Register">
    </form>
  </div>
</body>
</html>
