<!-- access_denied.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Access Denied</title>
  <link rel="stylesheet" href="../css/vet_app.css">
  <style>
    .access-container {
      max-width: 600px;
      margin: 100px auto;
      padding: 40px;
      text-align: center;
      background-color: #fff;
      border: 4px solid #e74c3c;
      border-radius: 15px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }
    .access-container h1 {
      color: #e74c3c;
      font-size: 2em;
      margin-bottom: 20px;
    }
    .access-container p {
      font-size: 1.2em;
      margin-bottom: 30px;
    }
    .access-container a {
      background-color: #2b6777;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
    }
    .access-container a:hover {
      background-color: #3d7d91;
    }
  </style>
</head>
<body>
  <div class="access-container">
    <h1>Access Denied</h1>
    <p>This page is only accessible to doctors.</p>
    <a href="main.php">Return to Main Page</a>
  </div>
</body>
</html>
