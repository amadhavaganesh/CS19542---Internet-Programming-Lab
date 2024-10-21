<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Default MySQL password
$dbname = "usersdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Use prepared statements to insert data into the login table
    $stmt = $conn->prepare("INSERT INTO login (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $pass);

    if ($stmt->execute()) {
        echo "Login details saved successfully!";
        // Redirect or perform further actions if needed
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css"> <!-- Link to the shared CSS file -->
</head>
<body>
  <div id="sectionLogin">
    <div class="box">
      <span class="borderline"></span>
      <form id="loginForm" action="login.php" method="POST">
        <h2>Login</h2>
        <div class="inputbox">
          <input type="text" id="loginUsername" name="username" required="required">
          <span>Username</span>
          <i></i>
        </div>
        <div class="inputbox">
          <input type="password" id="loginPassword" name="password" required="required">
          <span>Password</span>
          <i></i>
        </div>
        <div class="links">
          <a href="#">Forgot Password</a>
          <a href="signup.html">Signup</a>
        </div>
        <button class="but" style="--clr:#D4AF37" type="submit">Login</button>
      </form>
    </div>
  </div>
</body>
</html>
