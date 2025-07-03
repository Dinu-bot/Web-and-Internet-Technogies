<?php
require_once '../db/db_connect.php';

// Handle new pet submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['pet_name'];
    $type = $_POST['pet_type'];
    $age = $_POST['age'];
    $desc = $_POST['description'];
    $img = $_POST['image_path'];

    $sql = "INSERT INTO adoption_pets (pet_name, pet_type, age, description, image_path)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $name, $type, $age, $desc, $img);
    $stmt->execute();
    $stmt->close();
}

// Fetch pets
$fetch_sql = "SELECT * FROM adoption_pets";
$pets = $conn->query($fetch_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pet Adoption</title>
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
    <!-- Pet Adoption List -->
    <section>
      <h2>Available Pets for Adoption</h2>
      <p>These lovely pets are waiting for a forever home. Help give them a second chance!</p>
      <div class="pet-showcase">
        <?php while ($row = $pets->fetch_assoc()): ?>
          <div class="pet-item">
            <img src="<?= $row['image_path'] ?>" alt="<?= $row['pet_name'] ?>" width="120" style="border-radius: 50%;">
            <h3><?= $row['pet_name'] ?> (<?= $row['pet_type'] ?>)</h3>
            <p><?= $row['age'] ?> years old</p>
            <p><?= $row['description'] ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    </section>

    <!-- Register New Homeless Pet -->
    <section>
      <h2>Register a Pet for Adoption</h2>
      <form action="adoption.php" method="post">
        <label for="pet_name">Pet Name:</label>
        <input type="text" name="pet_name" required>

        <label for="pet_type">Pet Type:</label>
        <select name="pet_type" required>
          <option value="Dog">Dog</option>
          <option value="Cat">Cat</option>
          <option value="Rabbit">Rabbit</option>
          <option value="Other">Other</option>
        </select>

        <label for="age">Age:</label>
        <input type="number" name="age" min="0" required>

        <label for="description">Description:</label>
        <textarea name="description" rows="4"></textarea>

        <label for="image_path">Image Path (e.g. ../images/pet.jpg):</label>
        <input type="text" name="image_path" required>

        <input type="submit" value="Add Pet for Adoption">
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Happy Paws Veterinary Clinic. All rights reserved.</p>
  </footer>
</body>
</html>

<?php $conn->close(); ?>
