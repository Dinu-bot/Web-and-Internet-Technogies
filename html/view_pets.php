<?php
require_once '../db/db_connect.php';

// Fetch all records from the pets table
$sql = "SELECT * FROM pets";
$sql_appointment = "SELECT * FROM appointments";

//fetch all records from the appointments table
$result = $conn->query($sql);
$result_appointment = $conn->query($sql_appointment);

if ($result->num_rows > 0) {
    echo "<h2>Registered Pets</h2>";
    echo "<table border='1'>
            <tr>
                <th>Owner Name</th>
                <th>Email</th>
                <th>Pet Name</th>
                <th>Pet Type</th>
                <th>Breed</th>
                <th>Age</th>
                <th>Notes</th>
            </tr>";
    
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['owner_name'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['pet_name'] . "</td>
                <td>" . $row['pet_type'] . "</td>
                <td>" . $row['breed'] . "</td>
                <td>" . $row['age'] . "</td>
                <td>" . $row['notes'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No records found!";
}
if ($result_appointment->num_rows > 0) {
    echo "<h2>Upcoming Appointments</h2>";
    echo "<table border='1'>
            <tr>
                <th>Owner Name</th>
                <th>Email</th>
                <th>Pet Name</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Service Type</th>
            </tr>";
    
    // Output data for each appointment
    while ($row = $result_appointment->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['owner_name'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['pet_name'] . "</td>
                <td>" . $row['appointment_date'] . "</td>
                <td>" . $row['appointment_time'] . "</td>
                <td>" . $row['service_type'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No upcoming appointments found!";
}

$conn->close();
?>
