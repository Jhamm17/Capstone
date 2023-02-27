<?php
// Get the email parameter from the URL
$email = $_GET['email'];

// Connect to the database
$servername = "db.luddy.indiana.edu";
$username = "i494f22_team36";
$password = "my+sql=i494f22_team36";
$dbname = "i494f22_team36";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

// Query the database for the player's information based on the email parameter
// First, retrieve the user information and join with the profile table
$query = "SELECT Intramurals.user_email, Intramurals.Preferred_sport, Intramurals.On_team, CONCAT(Fname, ' ', Lname) AS full_name, user.userid AS userid
          FROM Intramurals 
          JOIN user ON Intramurals.user_email = user.email
          WHERE Intramurals.user_email = '$email'";

    $result = mysqli_query($conn, $query) or die('Error querying database.');
    $row = mysqli_fetch_array($result);

    // Then, retrieve the user profile information based on user ID
    $userid = $row['userid'];
    $sql = "SELECT * FROM profile WHERE userid = '$userid'"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    while($row_profile = $result->fetch_assoc()) {
        $favteam = $row_profile["FavTeam"];
        $favsport = $row_profile["FavSport"];
        $grad = $row_profile["GradYear"];
        $bio = $row_profile["bio"];
    }
    } else {
    echo "0 results";
    }
    ?>
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
      <div class="profile-box">
      <h1><?php echo $row['full_name'] ?>'s Profile</h1>
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
      <button><a href="intramuralplayers.php">Return to Player Search</a></button>
    </div> 
    </div> 
</body>
