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
          }
        });
        calendar.render();
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

    <center><div id='calendar'></div></center>
  </body>
</html>




