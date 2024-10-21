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

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $pass);

    if ($stmt->execute()) {
        echo "Signup successful!";
        echo "<br><a href='login.html'>Go to login</a>"; // Redirect to login after success
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
  <title>Sign Up</title>
  <link rel="stylesheet" href="signup.css"> <!-- Link to external CSS -->
</head>
<body>
  <div id="sectionSignup">
    <div class="box">
      <span class="borderline"></span>
      <form id="signupForm" action="signup.php" method="POST">
        <h2>Sign Up</h2>
        <div class="inputbox">
          <input type="text" id="signupUsername" name="username" required="required">
          <span>Username</span>
          <i></i>
        </div>
        <div class="inputbox">
          <input type="password" id="signupPassword" name="password" required="required">
          <span>Password</span>
          <i></i>
        </div>
        <div class="links">
          <a href="login.html">Already have an account? Log in</a>
        </div>
        <button class="but" style="--clr:#D4AF37" type="submit">Submit</button>
      </form>
    </div>
  </div>
</body>
</html>

