<form method="post" action="edit-profile.php">

  <label for="GradYear">Graduation Year:</label>
  <input type="number" name="GradYear" value="<?php echo $GradYear ?>" />

  <input type="submit" value="Update Profile" />
</form>

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

// Update user data
$sql = "UPDATE profile SET GradYear = ? WHERE userid = 1001";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $_POST["GradYear"], $userid);
$stmt->execute();

// Close the database connection
$conn->close();

// Redirect to the profile page
header("Location: profile.php");
exit;
?>





