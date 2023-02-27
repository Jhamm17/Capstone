<?php
// Get the email parameter from the URL
$email = $_GET['email'];

// Connect to the database
$db = mysqli_connect("db.luddy.indiana.edu","i494f22_samanort","my+sql=i494f22_samanort","i494f22_samanort") or die("Error connecting to MySQL server.");

// Query the database for the player's information based on the email parameter
$query = "SELECT * FROM Intramurals WHERE user_email = '$email'";
$query1 = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($db, $query) or die('Error querying database.');
$row = mysqli_fetch_array($result);

// Generate the HTML for the player's profile page
echo "<h1>Player Profile</h1>";
echo "<p><b>Name:</b> " . $row['Fname'] . "</p>";
echo "<p><b>Email:</b> " . $row['user_email'] . "</p>";
echo "<p><b>Preferred Sport:</b> " . $row['Preferred_sport'] . "</p>";
echo "<p><b>On Team:</b> " . $row['On_team'] . "</p>";
// Add additional fields as needed

// Close the database connection
mysqli_close($db);
?>
