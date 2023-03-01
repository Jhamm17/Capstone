<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() { //https://developer.mozilla.org/en-US/docs/Web/API/Document/DOMContentLoaded_event used site in order to determine how to properly display events on calendar through fullcalendar.io
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: {
      url: 'get-events.php',
      method: 'POST',
      failure: function() {
        console.log('Failed to load events');
      }
    },
    eventClick: function(info) {
  document.getElementById('event-title').innerHTML = info.event.title;
  document.getElementById('event-description').innerHTML = info.event.extendedProps.description;
  document.getElementById('event-start').innerHTML = info.event.start;
} //https://stackoverflow.com/questions/71176603/fullcalendar-add-custom-fields-from-json-feed-to-javascript-object Go information on how to call variables ot page in order to properly display when clicked

  });
  calendar.render();
});
    </script>
    <style>
      #calendar {
        width: 60%;
        padding-top: 1rem;
      }

      .fc-view-container {
        height: 100px;
      }
    </style>
  </head>

  <link rel="stylesheet" href="css/styles.css">
  <body>
  <div class="topnav"> 
        <a href="homepage.php"><img class="homeImg" src="Images/homebutton.png" alt="Home"></a>
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
    <h3 id="event-title"></h3>
    <p id="event-description"></p>
    <p id="event-start"></p>
    <center><div id='calendar'></div></center>


  </body>
</html>
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

$_SESSION['CAS'] = false;
if(!isset($_SESSION['CAS'])){
    header('Location: calender.php');
}

 if (isset($_GET["ticket"])){
     $tic = $_GET["ticket"];
     $request = "https://idp.login.iu.edu/idp/profile/cas/serviceValidate?ticket=" . $tic . "&service=https://cgi.luddy.indiana.edu/~team36/loign.php";
     $file = file_get_contents($request);
    // echo $file;
     //var_dump($file);
     $dom = new DomDocument();
     $dom->loadXML($file);
     $xpath = new DomXPath($dom);
     $node = $xpath->query("//cas:user");
     // office hours thursday with makejari
     if ($node->length){
         $username=trim($node[0]->textContent);
        
         $_SESSION["username"] = $username;
         //echo $username;
         $emailend =trim('@iu.edu');
         //$user = substr($file,0,-50);
         //echo strrev($user);
         $IUemail =$username.$emailend;
         $_SESSION["email"] = trim($IUemail);
         //echo $IUemail;
        // echo $IUemail;
        // echo $IUemail;
        $email = trim($_SESSION['email']);

        $compare = "SELECT * FROM user WHERE email=" . "'" . $email . "'";
        $query = mysqli_query($conn,$compare);
         if (mysqli_num_rows($query) == 0){
             echo "fill out login first";

         }else{
            //  $userid = "SELECT userid FROM user WHERE email=" . "'" . $email . "'";
            //  $qu = mysqli_query($conn,$userid);
            header("Location: calendar.php");



