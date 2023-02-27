<?php
//session_start();
$servername = "db.luddy.indiana.edu";
$username = "i494f22_team36";
$password = "my+sql=i494f22_team36";
$dbname = "i494f22_team36";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//$_SESSION['email'] = $IUemail;
$sql = "SELECT * FROM user WHERE email = 1001"; 
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
  header('Location: loign.php');
  exit();
} //https://7topics.com/creating-user-profile-page-using-php-and-mysql.html was used as a refresher to see how to properly set up connections and see how to call each variable

$sql = "SELECT * FROM profile WHERE userid = 1001"; 
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
  <link rel="stylesheet" href="css/porfiletest.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  
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
   
<!-- https://7topics.com/creating-user-profile-page-using-php-and-mysql.html used to see how to properly echo onto page -->
<div class="wrapper">
    <div class="left">
        <h4><?php echo $name ?></h4>
    </div>
    <div class="right">
        <div class="info">
            <h3>Information</h3>
            <div class="info_data">
                 <div class="data">
                    <h4>Email</h4>
                    <p><?php echo $email ?></p>
                 </div>
                 <div class="data">
                   <h4>Graduation Year</h4>
                    <p><?php echo $grad ?></p>
              </div>
            </div>
        </div>
      
      <div class="projects">
            <h3>About Me</h3>
            <div class="projects_data">
                 <div class="data">
                    <h4>Bio</h4>
                    <p><?php echo $bio ?></p>
                 </div>
                 <div class="data">
                   <h4>Favorite Team</h4>
                    <p><?php echo $favteam ?></p>
              </div>
              <div class="data">
                <h4>Favorite Sport</h4>
                 <p><?php echo $favsport ?></p>
           </div>
            </div>
        </div>
  </body>
</html>
