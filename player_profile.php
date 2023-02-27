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
$query = "SELECT Intramurals.user_email, Intramurals.Preferred_sport, Intramurals.On_team, CONCAT(Fname, ' ', Lname) AS full_name, user.id AS user_id
          FROM Intramurals 
          JOIN user ON Intramurals.user_email = user.email
          WHERE Intramurals.user_email = '$email'";

    $result = mysqli_query($conn, $query) or die('Error querying database.');
    $row = mysqli_fetch_array($result);

    // Then, retrieve the user profile information based on user ID
    $user_id = $row['user_id'];
    $sql = "SELECT * FROM profile WHERE userid = '$user_id'"; 
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

    // Finally, display the user and profile information
    echo "User Email: " . $row['user_email'] . "<br>";
    echo "Full Name: " . $row['full_name'] . "<br>";
    echo "Preferred Sport: " . $row['Preferred_sport'] . "<br>";
    echo "On Team: " . $row['On_team'] . "<br>";
    echo "Favorite Team: " . $favteam . "<br>";
    echo "Favorite Sport: " . $favsport . "<br>";
    echo "Graduation Year: " . $grad . "<br>";
    echo "Bio: " . $bio . "<br>";

