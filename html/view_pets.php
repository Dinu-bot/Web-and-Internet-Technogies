<?php
require_once '../db/db_connect.php';

$sql = "SELECT * FROM pets";
$sql_appointment = "SELECT * FROM appointments";
$result = $conn->query($sql);
$result_appointment = $conn->query($sql_appointment);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>View Pets & Appointments - Happy Paws</title>
  <link rel="stylesheet" href="../css/vet_app.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

  <!-- Emergency Banner -->
  <div class="emergency-banner">
    <i class="fas fa-phone-alt"></i> 24/7 Emergency Hotline: (123) 456-PETS | For life-threatening emergencies
  </div>

  <!-- Header -->
  <header>
    <div class="clinic-logo">
      <span class="paw-print">🐾</span>
      <h1>Happy Paws Veterinary Clinic</h1>
      <span class="paw-print">🐾</span>
    </div>
    <nav>
      <ul>
        <li><a href="main.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="adoption.php"><i class="fas fa-heart"></i> Pet Adoption</a></li>
        <li><a href="vaccination.php"><i class="fas fa-syringe"></i> Vaccination</a></li>
        <li><a href="appoinment.php"><i class="fas fa-calendar-plus"></i> Book Appointment</a></li>
        <li><a href="register.php"><i class="fas fa-user-plus"></i> Register Your Pet</a></li>
        <li><a href="view_pets.php"><i class="fas fa-paw"></i> View Registered Pets</a></li>
      </ul>
    </nav>
  </header>

  <!-- Main Content -->
  <main>
    <section>
      <h2>Registered Pets</h2>
      <?php if ($result->num_rows > 0): ?>
        <table>
          <tr>
            <th>Owner Name</th>
            <th>Email</th>
            <th>Pet Name</th>
            <th>Pet Type</th>
            <th>Breed</th>
            <th>Age</th>
            <th>Notes</th>
          </tr>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['owner_name']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['pet_name']) ?></td>
              <td><?= htmlspecialchars($row['pet_type']) ?></td>
              <td><?= htmlspecialchars($row['breed']) ?></td>
              <td><?= htmlspecialchars($row['age']) ?></td>
              <td><?= htmlspecialchars($row['notes']) ?></td>
            </tr>
          <?php endwhile; ?>
        </table>
      <?php else: ?>
        <div class="warning-box">No pet records found.</div>
      <?php endif; ?>
    </section>

    <section>
      <h2>Upcoming Appointments</h2>
      <?php if ($result_appointment->num_rows > 0): ?>
        <table>
          <tr>
            <th>Owner Name</th>
            <th>Email</th>
            <th>Pet Name</th>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
            <th>Service Type</th>
          </tr>
          <?php while ($row = $result_appointment->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['owner_name']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['pet_name']) ?></td>
              <td><?= htmlspecialchars($row['appointment_date']) ?></td>
              <td><?= htmlspecialchars($row['appointment_time']) ?></td>
              <td><?= htmlspecialchars($row['service_type']) ?></td>
            </tr>
          <?php endwhile; ?>
        </table>
      <?php else: ?>
        <div class="warning-box">No upcoming appointments found.</div>
      <?php endif; ?>
    </section>
  </main>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Happy Paws Veterinary Clinic. All rights reserved.</p>
    <p style="margin-top: 5px; font-size: 0.9em;">
      <i class="fas fa-shield-alt"></i> Licensed & Insured |
      <i class="fas fa-award"></i> AAHA Accredited |
      <i class="fas fa-heart"></i> Serving the community since 2010
    </p>
  </footer>

</body>
</html>
<?php $conn->close(); ?>
