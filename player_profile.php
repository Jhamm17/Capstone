<?php
// Get the email parameter from the URL
$email = $_GET['email'];

// Connect to the database
$servername = "db.luddy.indiana.edu";
$username = "i494f22_team36";
$password = "my+sql=i494f22_team36";
$dbname = "i494f22_team36";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

// Query the database for the player's information based on the email parameter
$query = "SELECT Intramurals.user_email, Intramurals.Preferred_sport, Intramurals.On_team, user.Fname 
          FROM Intramurals 
          JOIN user ON Intramurals.user_email = user.email
          WHERE Intramurals.user_email = '$email'";
$result = mysqli_query($conn, $query) or die('Error querying database.');
$row = mysqli_fetch_array($result);

// Generate the HTML for the player's profile page
echo "<h1>Player Profile</h1>";
echo "<p><b>Name:</b> " . $row['Fname'] . "</p>";
echo "<p><b>Email:</b> " . $row['user_email'] . "</p>";
echo "<p><b>Preferred Sport:</b> " . $row['Preferred_sport'] . "</p>";
echo "<p><b>On Team:</b> " . $row['On_team'] . "</p>";
// Add additional fields as needed

// Close the database connection
mysqli_close($db);
?>
