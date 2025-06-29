<?php
// You can add PHP logic here if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Happy Paws Veterinary Clinic - Your Pet's Health Partner</title>
  <link rel="stylesheet" href="../css/vet_app.css" />
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <!-- Emergency Banner -->
  <div class="emergency-banner">
    <i class="fas fa-phone-alt"></i> 24/7 Emergency Hotline: (123) 456-PETS | For life-threatening emergencies
  </div>

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
      </ul>
    </nav>
  </header>

  <main>
    <!-- Hero Section -->
    <section class="hero-section">
      <h1>🐕 Welcome to Happy Paws! 🐱</h1>
      <p>Your trusted partner in pet health and happiness. Providing compassionate veterinary care for over 15 years.</p>
      <div class="hours-today">
        <strong>Today's Hours:</strong> 
        <span class="status-open">OPEN</span> 8:00 AM - 8:00 PM
      </div>
    </section>

    <!-- Services Grid -->
    <section>
      <h2 style="text-align: center; margin-bottom: 30px; font-size: 2em;">🏥 Our Premium Services</h2>
      <div class="services-grid">
        <div class="service-card">
          <div class="service-icon">🩺</div>
          <h3>General Checkups</h3>
          <p>Comprehensive health examinations to keep your pet in optimal condition. Regular checkups help prevent diseases and ensure early detection of any health issues.</p>
          <a href="appoinment.php?service=general-checkup" class="cta-button">Book Checkup</a>
        </div>

        <div class="service-card">
          <div class="service-icon">💉</div>
          <h3>Vaccinations</h3>
          <p>Complete vaccination programs to protect your pets from dangerous diseases. We follow the latest vaccination schedules recommended by veterinary associations.</p>
          <a href="vaccination.php" class="cta-button">View Schedule</a>
        </div>

        <div class="service-card">
          <div class="service-icon">🏠</div>
          <h3>Pet Adoption</h3>
          <p>Find your perfect companion from our adoption program. We help match loving pets with caring families, including full health screening and support.</p>
          <a href="adoption.php" class="cta-button">Find a Pet</a>
        </div>

        <div class="service-card">
          <div class="service-icon">🚨</div>
          <h3>Emergency Care</h3>
          <p>24/7 emergency services for critical situations. Our experienced team is always ready to provide life-saving care when your pet needs it most.</p>
          <a href="appoinment.php?service=emergency" class="cta-button">Emergency Info</a>
        </div>

        <div class="service-card">
          <div class="service-icon">🦷</div>
          <h3>Dental Care</h3>
          <p>Professional dental cleaning and oral health maintenance. Dental health is crucial for your pet's overall wellbeing and quality of life.</p>
          <a href="appoinment.php?service=dental-care" class="cta-button">Book Dental</a>
        </div>

        <div class="service-card">
          <div class="service-icon">✂️</div>
          <h3>Grooming Services</h3>
          <p>Professional grooming services to keep your pet looking and feeling their best. From basic baths to full styling and nail trimming.</p>
          <a href="appoinment.php?service=grooming" class="cta-button">Book Grooming</a>
        </div>
      </div>
    </section>

    <!-- Pet Showcase -->
    <section>
      <h2 style="text-align: center; margin-bottom: 20px;">🐾 We Care for All Types of Pets</h2>
      <div class="pet-showcase" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px;">
      <div class="pet-item" style="flex: 0 1 150px; text-align: center;">
        <div style="font-size: 3em;">🐕</div>
        <h4>Dogs</h4>
        <p>All breeds welcome</p>
      </div>
      <div class="pet-item" style="flex: 0 1 150px; text-align: center;">
        <div style="font-size: 3em;">🐱</div>
        <h4>Cats</h4>
        <p>Feline specialists</p>
      </div>
      <div class="pet-item" style="flex: 0 1 150px; text-align: center;">
        <div style="font-size: 3em;">🐰</div>
        <h4>Rabbits</h4>
        <p>Exotic pet care</p>
      </div>
      <div class="pet-item" style="flex: 0 1 150px; text-align: center;">
        <div style="font-size: 3em;">🐦</div>
        <h4>Birds</h4>
        <p>Avian medicine</p>
      </div>
      <div class="pet-item" style="flex: 0 1 150px; text-align: center;">
        <div style="font-size: 3em;">🐹</div>
        <h4>Small Pets</h4>
        <p>Hamsters, guinea pigs</p>
      </div>
      <div class="pet-item" style="flex: 0 1 150px; text-align: center;">
        <div style="font-size: 3em;">🦎</div>
        <h4>Reptiles</h4>
        <p>Specialized care</p>
      </div>
      </div>
    </section>

    <!-- Important Information -->
    <section>
      <div class="info-box">
        <h3><i class="fas fa-info-circle"></i> New Pet Owners</h3>
        <p><strong>First visit?</strong> Please <a href="register.php">register your pet</a> before booking an appointment. This helps us provide the best care tailored to your pet's needs.</p>
      </div>

      <div class="warning-box">
        <h3><i class="fas fa-exclamation-triangle"></i> COVID-19 Safety Measures</h3>
        <p>We follow strict safety protocols. Please call ahead for curbside service options and updated procedures for in-clinic visits.</p>
      </div>
    </section>

    <!-- Contact Information -->
    <section class="contact-info">
      <h3><i class="fas fa-map-marker-alt"></i> Visit Our Modern Facility</h3>
      <p>Conveniently located in the heart of Pet City with ample parking and easy access.</p>
      
      <div class="contact-details">
        <div class="contact-item">
          <strong><i class="fas fa-map-marker-alt"></i> Address</strong>
          123 Pet Care Avenue<br>
          Animal City, AC 12345
        </div>
        
        <div class="contact-item">
          <strong><i class="fas fa-phone"></i> Phone Numbers</strong>
          Main: (123) 456-7890<br>
          Emergency: (123) 456-PETS
        </div>
        
        <div class="contact-item">
          <strong><i class="fas fa-envelope"></i> Email</strong>
          info@happypaws.com<br>
          appointments@happypaws.com
        </div>
        
        <div class="contact-item">
          <strong><i class="fas fa-clock"></i> Operating Hours</strong>
          Mon-Fri: 8:00 AM - 8:00 PM<br>
          Sat-Sun: 9:00 AM - 6:00 PM<br>
          <span style="color: #dc3545;">Emergency: 24/7</span>
        </div>
      </div>
    </section>

  </main>

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
