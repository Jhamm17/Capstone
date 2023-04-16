<?php
session_start();
$servername = "db.luddy.indiana.edu";
$username = "i494f22_team36";
$password = "my+sql=i494f22_team36";
$dbname = "i494f22_team36";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $userid = 1001;
// $sql = "SELECT * FROM user WHERE userid = $userid";
// $result = $conn->query($sql);
$email = trim($_SESSION['email']);
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = $conn->query($sql);
//https://www.w3schools.com/php/func_mysqli_query.asp used to help gett proper setup
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $name = $row["Fname"];
    $FavTeam = $row["FavTeam"];
    $FavSport = $row["FavSport"];
    $grad = $row["GradYear"];
    $bio = $row["bio"];
  }
} else {
  echo "0 results";
}
if (!$result) {
  printf("Error: %s\n", mysqli_error($conn));
  exit();
}

// $sql = "SELECT * FROM profile WHERE userid = $userid";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//   while($row = $result->fetch_assoc()) {
//     $favteam = $row["FavTeam"];
//     $favsport = $row["FavSport"];
//     $grad = $row["GradYear"];
//     $bio = $row["bio"];
//   }
// } else {
//   echo "0 results";
// }

if (isset($_POST["submit"])) {
  $FavTeam = $_POST["FavTeam"];
  $FavSport = $_POST["FavSport"];
  $grad = $_POST["grad"];
  $bio = $_POST["bio"];

  $sql = "UPDATE user SET FavTeam = '$FavTeam', FavSport = '$FavSport', GradYear = '$grad', bio = '$bio' WHERE email = '$email'";

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
  <?php
  session_start();
  if(!$_SESSION['authenticated']){
      header('Location: homelogin.php');
  }
  ?>
  <body>
  <div class="topnav"> 
        <a href="homepage.php"><img class="homeImg" src="Images/smallLogo.png" alt="Home"></a>
        <a href="calendar.php">Calendar</a>
        <a href="community.php">Community</a> 
        <a href="intramurals.php">Intramural Sports</a>    
        <a href="polls.php">Polls</a>
        <a href="profile2.php">Profile</a>
        <a href="https://idp.login.iu.edu/idp/profile/cas/logout">Log-Out </a>
    </div>
    <div class="profile">
    <div class="profile-box">
    <h1><?php echo $name ?>'s Profile</h1>
    <h2>Edit Your Profile</h2>
    <form action="profile.php" method="post">
      <label for="FavTeam">Favorite Team:</label>
      <input type="text" id="FavTeam" name="FavTeam" value="<?php echo $FavTeam ?>"><br>

      <label for="FavSport">Favorite Sport:</label>
      <input type="text" id="FavSport" name="FavSport" value="<?php echo $FavSport ?>"><br>

      <label for="grad">Graduation Year:</label>
      <input type="text" id="grad" name="grad" value="<?php echo $grad ?>"><br>

      <label for="bio">About Me:</label>
      <textarea id="bio" name="bio"><?php echo $bio ?></textarea><br>

      <input type="submit" name="submit" value="Update Profile">
    </form>
  </div>
  </div>
</body>
