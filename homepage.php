<!DOCTYPE html>
<html lang="en">
<head>
</head>
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
}
?>
<?php
session_start();
if(!$_SESSION['authenticated']){
    header('Location: homelogin.php');
}
?>
<link rel="stylesheet" href="css/homepage.css">
<div class="topnav"> 
        <a href="homepage.php"><img class="homeImg" src="Images/smallLogo.png" alt="Home"></a>
        <a href="calendar.php">Calendar</a>
        <a href="chat.php">Chat</a> 
        <a href="community.php">Community</a> 
        <a href="intramurals.php">Intramural Sports</a> 
        <a href="live.php">IU Live</a>   
        <a href="polls.php">Polls</a>
        <a href="profile2.php">Profile</a>
        <a href="https://idp.login.iu.edu/idp/profile/cas/logout">Log-Out </a>
</div>
<body>
<!-- <div class="Logo">
<img src="Images/SportsSocialLogo.png" alt="Logo"></a>
</div> -->
<div class="welcometext">
<h2> Welcome <?php echo $name ?> to  Sports Social! </h2>
</div>
</div>
<div class="descript">
  <p>Sport's Social is a website aimed to help Indiana University 
    students connect through sports. Whether that be watching, playing, or just talking about them this is the place where you can find it all!</p>
</div>
<div class="homescreenimage">
  <div class="imagelinks">
  <a href="https://cgi.luddy.indiana.edu/~team36/community.php">
  <img src="Images/IUlogo.png" alt="Iulogo">
  </a>
  <p>Click the image to check out some communities and talk sports.</p>
  </div>
  <div class="imagelinks">
  <a href="https://cgi.luddy.indiana.edu/~team36/calendar.php">
  <img src="Images/IUathlete.png" alt="IU">
  </a>
  <p>Want to know when the upcoming games are? Check out our calendar by clicking above.</p>
  </div>
  <div class="imagelinks">
  <a href="https://www.idsnews.com/section/sports">
  <img src="Images/IDSsports.jpeg" alt="IDS">
  </a>
  <p>Click to check out Indiana Daily students sports reports.</p>
  </div>
</div>
<footer>
    <p>&copy; 2023 Rights Reserved to Sports Social | <a href="https://cgi.luddy.indiana.edu/~team36/About.php">About Us</a></p>
</footer>
</body>
</html>
