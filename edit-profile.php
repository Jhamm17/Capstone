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
$userid = 1001; // Replace with the user's ID
$sql = "SELECT * FROM user WHERE userid = $userid";
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

$sql = "SELECT * FROM profile WHERE userid = $userid"; // Replace with the user's ID
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

// If form is submitted
if (isset($_POST["submit"])) {
  $favteam = $_POST["favteam"];
  $favsport = $_POST["favsport"];
  $grad = $_POST["grad"];
  $bio = $_POST["bio"];

  $sql = "UPDATE profile SET FavTeam = '$favteam', FavSport = '$favsport', GradYear = '$grad', bio = '$bio' WHERE userid = $userid";

  if ($conn->query($sql) === TRUE) {
    // Profile successfully updated
    header("Location: profile.php");
    exit;
  } else {
    echo "Error updating profile: " . $conn->error;
  }
}
if ($conn->query($sql) === TRUE) {
    // Database update was successful, redirect the user to the profile page
    header("Location: profile.php");
    exit();
  } else {
    // Handle the error case
    echo "Error updating record: " . $conn->error;
  }

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
    <head> 
    </head>
  <link rel="stylesheet" href="css/styles.css">
  
  <body>
  <div class="profile">
    <h1><?php echo $name ?>'s Profile</h1>
    <h2>Edit Your Profile</h2>
    <form action="profile.php" method="post">
      <label for="favteam">Favorite Team:</label>
      <input type="text" id="favteam" name="favteam" value="<?php echo $favteam ?>"><br>

      <label for="favsport">Favorite Sport:</label>
      <input type="text" id="favsport" name="favsport" value="<?php echo $favsport ?>"><br>

      <label for="grad">Graduation Year:</label>
      <input type="text" id="grad" name="grad" value="<?php echo $grad ?>"><br>

      <label for="bio">About Me:</label>
      <textarea id="bio" name="bio"><?php echo $bio ?></textarea><br>

      <input type="submit" name="submit" value="Update Profile">
    </form>
  </div>
</body>
