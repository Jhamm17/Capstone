<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
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
}

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
    <h3 id="event-title"></h3>
    <h3 id="event-description"></h3>
    <center><div id='calendar'></div></center>


  </body>
</html>




