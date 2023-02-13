<?php
// Connect to the database and retrieve the user's data
$servername = "db.luddy.indiana.edu";
$username = "i494f22_team36";
$password = "my+sql=i494f22_team36";
$dbname = "i494f22_team36";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve user data
$sql = "SELECT * FROM user WHERE userid = 1001"; // Replace with the user's ID
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Output data of each row
  while($row = $result->fetch_assoc()) {
    $name = $row["Fname"];
    $email = $row["email"];
  }
} else {
  echo "0 results";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $name ?>'s Profile Page</title>
  </head>
  <body>
    <h1><?php echo $name ?>'s Profile</h1>
    <h2>Contact Me</h2>
    <p>Email: <?php echo $email ?></p>
  </body>
</html>