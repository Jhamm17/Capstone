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
<?php
session_start();
if(!$_SESSION['authenticated']){
    header('Location: homelogin.php');
}
//else{
  //  header('Location: calendar.php');
//}
?>
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
    <h3 id="event-title"></h3>
    <p id="event-description"></p>
    <p id="event-start"></p>
    <center><div id='calendar'></div></center>


  </body>
</html>
