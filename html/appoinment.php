<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Book Appointment</title>
  <link rel="stylesheet" href="../css/vet_app.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script>
    function validateAppointmentForm(event) {
      var ownerName = document.getElementById('owner-name').value.trim();
      var email = document.getElementById('email').value.trim();
      var petName = document.getElementById('pet-name').value.trim();
      var appointmentDate = document.getElementById('appointment-date').value;
      var appointmentTime = document.getElementById('appointment-time').value;
      var serviceType = document.getElementById('service-type').value;

      if (ownerName === "") {
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
      if (appointmentDate === "") {
        alert("Appointment Date is required.");
        event.preventDefault();
        return false;
      }
      if (appointmentTime === "") {
        alert("Appointment Time is required.");
        event.preventDefault();
        return false;
      }
      if (serviceType === "") {
        alert("Service Type is required.");
        event.preventDefault();
        return false;
      }
      
      // Check if appointment date is not in the past
      var selectedDate = new Date(appointmentDate);
      var today = new Date();
      today.setHours(0, 0, 0, 0);
      
      if (selectedDate < today) {
        alert("Appointment date cannot be in the past.");
        event.preventDefault();
        return false;
      }
      
      return true;
    }

    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('appointment-form').addEventListener('submit', validateAppointmentForm);
      
      // Set minimum date to today
      var today = new Date().toISOString().split('T')[0];
      document.getElementById('appointment-date').setAttribute('min', today);
    });
  </script>
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
      <h2>Book an Appointment</h2>
      <p>Schedule an appointment for your registered pet. Please ensure your pet is already registered in our system.</p>
      
      <form id="appointment-form" action="process_appointment.php" method="post">
        <label for="owner-name">Owner's Name:</label><br />
        <input type="text" id="owner-name" name="owner-name" placeholder="Enter your full name"><br /><br />

        <label for="email">Email:</label><br />
        <input type="email" id="email" name="email" placeholder="Enter your email address"><br /><br />

        <label for="pet-name">Pet's Name:</label><br />
        <input type="text" id="pet-name" name="pet-name" placeholder="Enter your pet's name"><br /><br />

        <label for="appointment-date">Appointment Date:</label><br />
        <input type="date" id="appointment-date" name="appointment-date"><br /><br />

        <label for="appointment-time">Appointment Time:</label><br />
        <select id="appointment-time" name="appointment-time">
          <option value="">--Select Time--</option>
          <option value="09:00">9:00 AM</option>
          <option value="09:30">9:30 AM</option>
          <option value="10:00">10:00 AM</option>
          <option value="10:30">10:30 AM</option>
          <option value="11:00">11:00 AM</option>
          <option value="11:30">11:30 AM</option>
          <option value="14:00">2:00 PM</option>
          <option value="14:30">2:30 PM</option>
          <option value="15:00">3:00 PM</option>
          <option value="15:30">3:30 PM</option>
          <option value="16:00">4:00 PM</option>
          <option value="16:30">4:30 PM</option>
          <option value="17:00">5:00 PM</option>
        </select><br /><br />

        <label for="service-type">Service Type:</label><br />
        <select id="service-type" name="service-type">
          <option value="">--Select Service--</option>
          <option value="general-checkup">General Checkup</option>
          <option value="vaccination">Vaccination</option>
          <option value="dental-care">Dental Care</option>
          <option value="surgery">Surgery Consultation</option>
          <option value="emergency">Emergency Care</option>
          <option value="grooming">Grooming</option>
          <option value="other">Other</option>
        </select><br /><br />

        <label for="reason">Reason for Visit:</label><br />
        <textarea id="reason" name="reason" rows="4" cols="50" placeholder="Please describe the reason for your visit or any specific concerns..."></textarea><br /><br />

        <label for="phone">Contact Phone (Optional):</label><br />
        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number"><br /><br />

        <input type="submit" value="Book Appointment">
        <input type="reset" value="Clear Form">
      </form>
      
      <div style="margin-top: 20px; padding: 15px; background-color: #f0f8ff; border-left: 4px solid #4CAF50;">
        <h3>Important Notes:</h3>
        <ul>
          <li>Your pet must be registered in our system before booking an appointment</li>
          <li>Please arrive 15 minutes before your scheduled appointment</li>
          <li>Bring your pet's vaccination records if available</li>
          <li>For emergency cases, please call us directly</li>
          <li>Cancellations must be made at least 24 hours in advance</li>
        </ul>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Happy Paws Veterinary Clinic. All rights reserved.</p>
  </footer>
</body>
</html>
