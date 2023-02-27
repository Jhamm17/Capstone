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
    <div class="profile">
      <h1><?php echo $name ?>'s Profile</h1>
      <h2>Contact Me</h2>
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
      <a href="profile.php">Edit Profile</a>
    </div> 
