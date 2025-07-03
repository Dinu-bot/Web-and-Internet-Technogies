
<?php
  session_start(); // required for session access
  require_once '../db/db_connect.php';

// 🔐 Restrict access to doctors only
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'doctor') {
    header("Location: access_denied.php");
    exit();
}

// Handle quantity reduction
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['decrease_id'])) {
    $id = intval($_POST['decrease_id']);
    $conn->query("UPDATE vaccines SET quantity = quantity - 1 WHERE id = $id AND quantity > 0");
}

// Handle vaccine addition
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_vaccine'])) {
    $pet_type = $conn->real_escape_string($_POST['pet_type']);
    $vaccine_name = $conn->real_escape_string($_POST['vaccine_name']);
    $age_range = $conn->real_escape_string($_POST['age_range']);
    $description = $conn->real_escape_string($_POST['description']);
    $quantity = intval($_POST['quantity']);

    $sql = "INSERT INTO vaccines (pet_type, vaccine_name, age_range, description, quantity) 
            VALUES ('$pet_type', '$vaccine_name', '$age_range', '$description', $quantity)";
    $conn->query($sql);
}

// Fetch vaccine records
$result = $conn->query("SELECT * FROM vaccines ORDER BY pet_type, age_range");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Vaccination Info</title>
  <link rel="stylesheet" href="../css/vet_app.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <header>
    <h1>Happy Paws Veterinary Clinic</h1>
    <nav>
      <ul>
        <li><a href="main.php"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="adoption.php"><i class="fas fa-heart"></i> Pet Adoption</a></li>
      <li><a href="appoinment.php"><i class="fas fa-calendar-plus"></i> Book Appointment</a></li>
      <li><a href="register.php"><i class="fas fa-user-plus"></i> Register Your Pet</a></li>
      <li><a href="vaccination.php"><i class="fas fa-syringe"></i> Vaccination</a></li>
      <li><a href="view_pets.php"><i class="fas fa-paw"></i> View Registered Pets</a></li>
      <li style="float:right;"><a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a></li>
      <li style="float:right;"><a href="login_register_logout.php?logout=1"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section>
      <h2>Available Vaccines</h2>
      <?php
      if ($result->num_rows > 0) {
          echo "<table>
                  <tr>
                    <th>Pet Type</th>
                    <th>Vaccine Name</th>
                    <th>Recommended Age</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Action</th>
                  </tr>";
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>" . htmlspecialchars($row['pet_type']) . "</td>
                      <td>" . htmlspecialchars($row['vaccine_name']) . "</td>
                      <td>" . htmlspecialchars($row['age_range']) . "</td>
                      <td>" . htmlspecialchars($row['description']) . "</td>
                      <td>" . $row['quantity'] . "</td>
                      <td>
                        <form method='POST' style='display:inline-block'>
                          <input type='hidden' name='decrease_id' value='{$row['id']}'>
                          <input type='submit' value='-1'>
                        </form>
                      </td>
                    </tr>";
          }
          echo "</table>";
      } else {
          echo "<p>No vaccines found.</p>";
      }
      ?>
    </section>

    <section>
      <h2>Add New Vaccine</h2>
      <form method="POST">
        <label>Pet Type:</label><br>
        <input type="text" name="pet_type" required><br><br>

        <label>Vaccine Name:</label><br>
        <input type="text" name="vaccine_name" required><br><br>

        <label>Recommended Age Range:</label><br>
        <input type="text" name="age_range"><br><br>

        <label>Description:</label><br>
        <textarea name="description" rows="4" cols="50"></textarea><br><br>

        <label>Quantity:</label><br>
        <input type="number" name="quantity" min="0" required><br><br>

        <input type="submit" name="add_vaccine" value="Add Vaccine">
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Happy Paws Veterinary Clinic. All rights reserved.</p>
  </footer>
</body>
</html>






























