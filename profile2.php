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

if (!isset($_SESSION['userid'])) {
  // Redirect the user to the login page or show an error message
  header('Location: loign.php');
  exit();
}

$userid = $_SESSION['userid'];

$stmt = $conn->prepare("SELECT * FROM user WHERE userid = ?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $fname = $row["Fname"];
    $lname = $row["Lname"];
    $name = $fname . ' ' . $lname;
    $email = $row["email"];
  }
} else {
  // Redirect the user to the login page or show an error message
  header('Location: loign.php');
  exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
    <head> 
    </head>
  <link rel="stylesheet" href="css/styles.css">
  
  <body>
  <div class="topnav"> 
        <a href="home.html"><img class="homeImg" src="Images/homebutton.png" alt="Home"></a>
        <a href="calendar.php">Calendar</a>
        <a href="chat.php">Chat</a> 
        <a href="community.php">Community</a> 
        <a href="intramurals.php">Intramural Sports</a> 
        <a href="live.php">IU Live</a>   
        <a href="polls.php">Polls</a>
        <a href="profile2.php">Profile</a>
        <a href="https://idp.login.iu.edu/idp/profile/cas/login?service=https://cgi.luddy.indiana.edu/~team36/loign.php">Log-In</a> 
        <a href="https://idp.login.iu.edu/idp/profile/cas/logout">Log-Out </a>

    </div>
    <div class="profile">
      <h1><?php echo $name ?>'s Profile</h1>
      <h2>Contact Me</h2>
      <!-- <div class="info">
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
      <a href="profile.php">Edit Profile</a>
    </div>  -->
<!-- https://7topics.com/creating-user-profile-page-using-php-and-mysql.html used to see how to properly echo onto page -->
    
  </body>
</html>
