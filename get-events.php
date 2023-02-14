<?php
// Connect to the database and retrieve the events
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

// Retrieve events from the database
$sql = "SELECT title, start, end FROM calendar";
$result = $conn->query($sql);

// Format the events as JSON
$events = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $event = array();
    $event['title'] = $row['title'];
    $event['start'] = $row['start'];
    $event['end'] = $row['end'];
    $events[] = $event;
  }
}
$events = json_encode($events);

// Send the events data as a response
header('Content-Type: application/json');
echo $events;

// Close the database connection
$conn->close();
?>
