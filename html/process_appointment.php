<?php
require_once '../db/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $owner_name = mysqli_real_escape_string($conn, $_POST['owner-name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pet_name = mysqli_real_escape_string($conn, $_POST['pet-name']);
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment-date']);
    $appointment_time = mysqli_real_escape_string($conn, $_POST['appointment-time']);
    $service_type = mysqli_real_escape_string($conn, $_POST['service-type']);
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Verify pet registration
    $verify_sql = "SELECT id FROM pets WHERE owner_name = ? AND email = ? AND pet_name = ?";
    $verify_stmt = $conn->prepare($verify_sql);
    $verify_stmt->bind_param("sss", $owner_name, $email, $pet_name);
    $verify_stmt->execute();
    $verify_result = $verify_stmt->get_result();

    if ($verify_result->num_rows == 0) {
        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Appointment Booking - Error</title>
            <link rel='stylesheet' href='../css/vet_app.css'>
        </head>
        <body>
            <header>
                <h1>Happy Paws Veterinary Clinic</h1>
                <nav>
                    <ul>
                        <li><a href="main.php">Home</a></li>
                        <li><a href="adoption.php">Pet Adoption</a></li>
                        <li><a href="appoinment.php">Book Appointment</a></li>
                        <li><a href="register.php">Register Your Pet</a></li>
                        <li><a href="vaccination.php">Vaccination</a></li>
                        <li><a href="view_pets.php">View Registered Pets</a></li>
                        <li style="float:right;"><a href="profile.php">Profile</a></li>
                        <li style="float:right;"><a href="login_register_logout.php?logout=1">Logout</a></li>
                    </ul>
                </nav>
            </header>
            <main>
                <section>
                    <div style='padding: 20px; background-color: #ffebee; border-left: 4px solid #f44336; margin: 20px 0;'>
                        <h2>Pet Not Found!</h2>
                        <p>We could not find a pet registered with the following details:</p>
                        <ul>
                            <li><strong>Owner:</strong> <?= htmlspecialchars($owner_name) ?></li>
                            <li><strong>Email:</strong> <?= htmlspecialchars($email) ?></li>
                            <li><strong>Pet Name:</strong> <?= htmlspecialchars($pet_name) ?></li>
                        </ul>
                        <p>Please make sure:</p>
                        <ul>
                            <li>Your pet is registered in our system</li>
                            <li>The owner name, email, and pet name match exactly</li>
                            <li>There are no spelling errors</li>
                        </ul>
                        <p><a href='register.php'>Register your pet first</a> or <a href='appoinment.php'>try booking again</a> with the correct information.</p>
                    </div>
                </section>
            </main>
            <footer>
                <p>&copy; 2025 Happy Paws Veterinary Clinic. All rights reserved.</p>
            </footer>
        </body>
        </html>
        <?php
        exit();
    }

    $pet_id = $verify_result->fetch_assoc()['id'];

    // Check for time conflict
    $check_sql = "SELECT id FROM appointments WHERE appointment_date = ? AND appointment_time = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $appointment_date, $appointment_time);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Appointment Booking - Time Conflict</title>
            <link rel='stylesheet' href='../css/vet_app.css'>
        </head>
        <body>
            <header>
                <h1>Happy Paws Veterinary Clinic</h1>
                <nav>
                    <ul>
                        <li><a href="main.php">Home</a></li>
                        <li><a href="adoption.php">Pet Adoption</a></li>
                        <li><a href="appoinment.php">Book Appointment</a></li>
                        <li><a href="register.php">Register Your Pet</a></li>
                        <li><a href="vaccination.php">Vaccination</a></li>
                        <li><a href="view_pets.php">View Registered Pets</a></li>
                        <li style="float:right;"><a href="profile.php">Profile</a></li>
                        <li style="float:right;"><a href="login_register_logout.php?logout=1">Logout</a></li>
                    </ul>
                </nav>
            </header>
            <main>
                <section>
                    <div style='padding: 20px; background-color: #fff3cd; border-left: 4px solid #ffc107; margin: 20px 0;'>
                        <h2>Time Slot Already Booked!</h2>
                        <p>The selected appointment time (<?= htmlspecialchars($appointment_date) ?> at <?= htmlspecialchars($appointment_time) ?>) is already booked.</p>
                        <p>Please <a href='appoinment.php'>choose a different time slot</a>.</p>
                    </div>
                </section>
            </main>
            <footer><p>&copy; 2025 Happy Paws Veterinary Clinic. All rights reserved.</p></footer>
        </body>
        </html>
        <?php
        exit();
    }

    // Insert appointment with status and timestamp
    $sql = "INSERT INTO appointments (pet_id, owner_name, email, pet_name, appointment_date, appointment_time, service_type, reason, phone, status, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'scheduled', NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssssss", $pet_id, $owner_name, $email, $pet_name, $appointment_date, $appointment_time, $service_type, $reason, $phone);

    if ($stmt->execute()) {
        $appointment_id = $conn->insert_id;
        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Appointment Booked</title>
            <link rel='stylesheet' href='../css/vet_app.css'>
        </head>
        <body>
            <header>
                <h1>Happy Paws Veterinary Clinic</h1>
                <nav>
                    <ul>
                        <li><a href="main.php">Home</a></li>
                        <li><a href="adoption.php">Pet Adoption</a></li>
                        <li><a href="appoinment.php">Book Appointment</a></li>
                        <li><a href="register.php">Register Your Pet</a></li>
                        <li><a href="vaccination.php">Vaccination</a></li>
                        <li><a href="view_pets.php">View Registered Pets</a></li>
                        <li style="float:right;"><a href="profile.php">Profile</a></li>
                        <li style="float:right;"><a href="login_register_logout.php?logout=1">Logout</a></li>
                    </ul>
                </nav>
            </header>
            <main>
                <section>
                    <div style='padding: 20px; background-color: #d4edda; border-left: 4px solid #28a745; margin: 20px 0;'>
                        <h2>Appointment Booked Successfully!</h2>
                        <ul>
                            <li><strong>ID:</strong> #<?= $appointment_id ?></li>
                            <li><strong>Owner:</strong> <?= htmlspecialchars($owner_name) ?></li>
                            <li><strong>Pet:</strong> <?= htmlspecialchars($pet_name) ?></li>
                            <li><strong>Date:</strong> <?= htmlspecialchars($appointment_date) ?></li>
                            <li><strong>Time:</strong> <?= htmlspecialchars($appointment_time) ?></li>
                            <li><strong>Service:</strong> <?= htmlspecialchars($service_type) ?></li>
                        </ul>
                        <p>Confirmation email will be sent to: <strong><?= htmlspecialchars($email) ?></strong></p>
                    </div>
                    <div style='margin-top: 20px;'>
                        <a href='appoinment.php' class='btn'>Book Another Appointment</a>
                        <a href='main.php' class='btn' >Go to Home</a>
                    </div>
                </section>
            </main>
            <footer><p>&copy; 2025 Happy Paws Veterinary Clinic. All rights reserved.</p></footer>
        </body>
        </html>
        <?php
    } else {
        echo "<script>alert('Error occurred while booking. Try again.'); window.location.href='appoinment.php';</script>";
    }

    $stmt->close();
    $verify_stmt->close();
    $check_stmt->close();
} else {
    header("Location: appoinment.php");
    exit();
}

$conn->close();
?>


