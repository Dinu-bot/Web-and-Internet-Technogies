<?php
require_once '../db/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $owner_name = $_POST["owner-name"];
    $email = $_POST["email"];
    $pet_name = $_POST["pet-name"];
    $pet_type = $_POST["pet-type"];
    $breed = $_POST["breed"];
    $age = $_POST["age"];
    $notes = $_POST["notes"];

    // Prepare the SQL query
    $stmt = $conn->prepare("INSERT INTO pets (owner_name, email, pet_name, pet_type, breed, age, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssis", $owner_name, $email, $pet_name, $pet_type, $breed, $age, $notes);

    if ($stmt->execute()) {
        echo "<p>Pet registered successfully!</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register Your Pet</title>
  <link rel="stylesheet" href="../css/vet_app.css" />
</head>
<body>
  <header>
    <h1>Happy Paws Veterinary Clinic</h1>
    <nav>
      <ul>
        <li><a href="main.php">Home</a></li>
        <li><a href="adoption.php">Pet Adoption</a></li>
        <li><a href="vaccination.php">Vaccination</a></li>
        <li><a href="appoinment.php">Book Appointment</a></li>
        <li><a href="register.php">Register Your Pet</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section>
      <h2>Register Your Pet</h2>
      <form id="register-form" action="#" method="post" novalidate>
        <label for="owner-name">Owner's Name:</label><br />
        <input type="text" id="owner-name" name="owner-name"><br /><br />

        <label for="email">Email:</label><br />
        <input type="text" id="email" name="email"><br /><br />

        <label for="pet-name">Pet's Name:</label><br />
        <input type="text" id="pet-name" name="pet-name"><br /><br />

        <label for="pet-type">Pet Type:</label><br />
        <select id="pet-type" name="pet-type">
          <option value="">--Select--</option>
          <option value="dog">Dog</option>
          <option value="cat">Cat</option>
          <option value="bird">Bird</option>
          <option value="other">Other</option>
        </select><br /><br />

        <label for="breed">Breed:</label><br />
        <input type="text" id="breed" name="breed"><br /><br />

        <label for="age">Age (in years):</label><br />
        <input type="number" id="age" name="age" min="0"><br /><br />

        <label for="notes">Additional Notes:</label><br />
        <textarea id="notes" name="notes" rows="4" cols="50"></textarea><br /><br />

        <input type="submit" value="Register Pet">
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Happy Paws Veterinary Clinic. All rights reserved.</p>
  </footer>

  <!-- validation part -->
  <script>
    function validateForm(event) {
      var owner = document.getElementById('owner-name').value.trim();
      var email = document.getElementById('email').value.trim();
      var petName = document.getElementById('pet-name').value.trim();
      var petType = document.getElementById('pet-type').value;
      var age = document.getElementById('age').value;

      if (owner === "") {
        alert("Owner's Name is required.");
        event.preventDefault();
        return false;
      }
      if (email === "") {
        alert("Email is required.");
        event.preventDefault();
        return false;
      }
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        event.preventDefault();
        return false;
      }
      if (petName === "") {
        alert("Pet's Name is required.");
        event.preventDefault();
        return false;
      }
      if (petType === "") {
        alert("Pet Type is required.");
        event.preventDefault();
        return false;
      }
      if (age !== "" && (isNaN(age) || age < 0)) {
        alert("Please enter a valid age (0 or greater).");
        event.preventDefault();
        return false;
      }
      // All validations passed
      return true;
    }

    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('register-form').addEventListener('submit', validateForm);
    });
  </script>
</body>
</html>
