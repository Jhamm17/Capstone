<?php
// Connect to the database
$servername = "db.luddy.indiana.edu";
$username = "i494f22_team36";
$password = "my+sql=i494f22_team36";
$dbname = "i494f22_team36";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Update user data
if (isset($_POST['name']) && isset($_POST['email'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $sql = "UPDATE user SET Fname='$name', email='$email' WHERE userid=1001"; // Replace with the user's ID
  $conn->query($sql);
}

// Update profile data
if (isset($_POST['favteam']) && isset($_POST['favsport']) && isset($_POST['grad']) && isset($_POST['bio'])) {
  $favteam = $_POST['favteam'];
  $favsport = $_POST['favsport'];
  $grad = $_POST['grad'];
  $bio = $_POST['bio'];
  $sql = "UPDATE profile SET FavTeam='$favteam', FavSport='$favsport', GradYear='$grad', bio='$bio' WHERE userid=1001"; // Replace with the user's ID
  $conn->query($sql);
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

// Retrieve profile data
$sql = "SELECT * FROM profile WHERE userid = 1001"; // Replace with the user's ID
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Output data of each row
  while($row = $result->fetch_assoc()) {
    $favteam = $row["FavTeam"];
    $favsport = $row["FavSport"];
    $grad = $row["GradYear"];
    $bio = $row["bio"];
  }
} else {
  echo "0 results";
}