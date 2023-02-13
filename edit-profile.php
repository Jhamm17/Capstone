<form method="post" action="update-profile.php">
  <label for="name">Name:</label>
  <input type="text" name="name" value="<?php echo $name ?>" />

  <label for="email">Email:</label>
  <input type="email" name="email" value="<?php echo $email ?>" />

  <label for="graduation_year">Graduation Year:</label>
  <input type="number" name="graduation_year" value="<?php echo $graduation_year ?>" />

  <label for="bio">About Me:</label>
  <textarea name="bio"><?php echo $bio ?></textarea>

  <label for="fav_team">Favorite Team:</label>
  <input type="text" name="fav_team" value="<?php echo $fav_team ?>" />

  <label for="fav_sport">Favorite Sport:</label>
  <input type="text" name="fav_sport" value="<?php echo $fav_sport ?>" />

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
$sql = "UPDATE users SET Fname = ?, email = ?, grad_year = ?, bio = ?, fav_team = ?, fav_sport = ? WHERE userid = 1001"; // Replace with the user's ID
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisssi", $_POST["name"], $_POST["email"], $_POST["graduation_year"], $_POST["bio"], $_POST["fav_team"], $_POST["fav_sport"], $user_id);
$stmt->execute();

// Close the database connection
$conn->close();

// Redirect to the profile page
header("Location: profile.php");
exit;
?>