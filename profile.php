<?php
$servername = "db.luddy.indiana.edu";
$username = "i494f22_team36";
$password = "my+sql=i494f22_team36";
$dbname = "i494f22_team36";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
session_start();

// Check if the user is logged in
if (isset($_SESSION['userid'])) {
  $userid = $_SESSION['userid'];

  // Query the database with the user ID
  $sql = "SELECT * FROM user WHERE userid = $userid";
  $result = $conn->query($sql);
// $userid = 1001;
// $sql = "SELECT * FROM user WHERE userid = $userid";
// $result = $conn->query($sql);
//https://www.w3schools.com/php/func_mysqli_query.asp used to help gett proper setup
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $name = $row["Fname"];
    $email = $row["email"];
  }
} else {
  // Redirect the user to the login page or show an error message
  header('Location: login.php');
  exit();
}

$sql = "SELECT * FROM profile WHERE userid = $userid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $favteam = $row["FavTeam"];
    $favsport = $row["FavSport"];
    $grad = $row["GradYear"];
    $bio = $row["bio"];
  }
} else {
  echo "0 results";
}

if (isset($_POST["submit"])) {
  $favteam = $_POST["favteam"];
  $favsport = $_POST["favsport"];
  $grad = $_POST["grad"];
  $bio = $_POST["bio"];

  $sql = "UPDATE profile SET FavTeam = '$favteam', FavSport = '$favsport', GradYear = '$grad', bio = '$bio' WHERE userid = $userid";

  if ($conn->query($sql) === TRUE) {
    header("Location: profile2.php");
    exit;
  } else {
    echo "Error updating profile: " . $conn->error;
  }
}

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
