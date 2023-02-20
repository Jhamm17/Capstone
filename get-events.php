<?php

$servername = "db.luddy.indiana.edu";
$username = "i494f22_team36";
$password = "my+sql=i494f22_team36";
$dbname = "i494f22_team36";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT title, start, end, description FROM calendar";
$result = $conn->query($sql);

$events = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $event = array();
    $event['title'] = $row['title'];
    $event['start'] = $row['start'];
    $event['end'] = $row['end'];
    $event['description'] = $row['description'];
    $events[] = $event;
  }
}
$events = json_encode($events);


header('Content-Type: application/json'); //https://stackoverflow.com/questions/20620300/http-content-type-header-and-json Retrieved function from this site to see how to be able to proper call events that were set above
echo $events;

$conn->close();
?>
