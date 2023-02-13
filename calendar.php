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
$sql = "SELECT * FROM calendar";
$result = $conn->query($sql);

// Format the events as JSON
$calendar = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $calendar = array();
    $calendar['title'] = $row['title'];
    $calendar['start'] = $row['start'];
    $calendar['end'] = $row['end'];
    $calendar['description'] = $row['description'];
    // Add any other properties you want to associate with the event
    $events[] = $event;
  }
}
$calendar = json_encode($calendar);


// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

        $('#calendar').fullCalendar({
    calendar: <?php echo $calendar; ?>
    });
    </script>
    <style>
          #calendar {
    width: 65%;
    padding-top: 1rem;
  }

  .fc-view-container {
    height: 150px; 
  }
    </style>
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
        <a href="profile2.php">Profile</a>
        <a href="https://idp.login.iu.edu/idp/profile/cas/login?service=https://cgi.luddy.indiana.edu/~team36/loign.php">Log-In</a> 
    </div>
    <center><div id='calendar'></div></center>
  </body>
</html>



