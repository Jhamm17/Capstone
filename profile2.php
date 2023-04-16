<?php
session_start();
if(!$_SESSION['authenticated']){
    header('Location: homelogin.php');
}
?>
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

$email = trim($_SESSION['email']);
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $fname = $row["Fname"];
    $lname = $row["Lname"];
    $name = $fname . ' ' . $lname;
    $email = $row["email"];
  }
} else {
  // Redirect the user to the login page or show an error message
  // header('Location: loign.php');
  // exit();
  echo $_SESSION['email'];
  echo strlen($_SESSION['email']);
  echo strlen($query);
  echo $result;
} //https://7topics.com/creating-user-profile-page-using-php-and-mysql.html was used as a refresher to see how to properly set up connections and see how to call each variable

$sql = "SELECT FavTeam, FavSport,GradYear,bio FROM user WHERE email = '$email'"; 
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

$conn->close();
?>

<!DOCTYPE html>
<html>
    <head> 
    </head>
  <link rel="stylesheet" href="css/styles.css">

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
      <div class="info">
        <p class="descriptors">Email:</p>
        <p class="elements"><?php echo $email ?></p>
      </div>
      <div class="info">
        <p class="descriptors">Graduation Year:</p>
        <p class="elements"><?php echo $grad ?></p>
      </div>
      <div class="info">
        <p class="descriptors">About Me:</p>
        <p class="elements"><?php echo $bio ?></p>
      </div>
      <div class="info">
        <p class="descriptors">Favorite Team:</p>
        <p class="elements"><?php echo $favteam ?></p>
      </div>
      <div class="info">
        <p class="descriptors">Favorite Sport: </p>
        <p class="elements"><?php echo $favsport ?></p>
      </div>
      <a class="editprofilebutton" href="profile.php">Edit Profile</a>
    </div> 
    </div> 
<!-- https://7topics.com/creating-user-profile-page-using-php-and-mysql.html used to see how to properly echo onto page -->

  </body>
</html>