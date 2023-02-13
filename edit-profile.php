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

// Close the database connection
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
        <a href="cal.php">Calendar</a>
        <a href="chat.php">Chat</a> 
        <a href="community.html">Community</a> 
        <a href="intramurals.php">Intramural Sports</a> 
        <a href="live.html">IU Live</a>   
        <a href="polls.php">Polls</a>
        <a href="profile.php">Profile</a>
        <a href="https://idp.login.iu.edu/idp/profile/cas/login?service=https://cgi.luddy.indiana.edu/~team36/loign.php">Log-In</a> 
    </div>
    <div class="profile">
    <h1><?php echo $name ?>'s Profile</h1>
    <h2>Contact Me</h2>
    <p>Email: <?php echo $email ?></p>
    <p>Graduation Year: <?php echo $grad ?></p>
    <p>About Me:<?php echo $bio ?></p>
    <p>Favorite Team: <?php echo $favteam ?></p>
    <p>Favorite Sport: <?php echo $favsport ?></p>
    </div>
    <a href="edit-profile.php">Edit Profile</a>
  </body>
</html>