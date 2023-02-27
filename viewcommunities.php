<html>
    <head>
        <title>Community View Page</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="topnav">
            <a href="home.html"><img class="homeImg" src="Images/homebutton.png" alt="Home"></a>
            <a href="calendar.php">Calendar</a>
            <a href="chat.php">Chat</a> 
            <a href="community.php">Community</a> 
            <a href="intramurals.php">Intramural Sports</a> 
            <a href="live.html">IU Live</a>   
            <a href="polls.php">Polls</a>
            <a href="profile.php">Profile</a>
            <a href="https://idp.login.iu.edu/idp/profile/cas/login?service=https://cgi.luddy.indiana.edu/~team36/loign.php">Log-In</a> 
        </div>
        <h1>Community view </h1>
        <center>
            <table class="tabledesign">
                <?php
                    $db = mysqli_connect("db.luddy.indiana.edu","i494f22_samanort","my+sql=i494f22_samanort","i494f22_samanort") or die("Error connecting to MySQL server.");
                    if (mysqli_connect_errno()){
                        echo 'failed to connect to SQL';
                    }
                    $query1 = "SELECT * FROM community";
                    mysqli_query($db, $query1) or die('Error querying database.');
                    $result = mysqli_query($db, $query1);
                    $row = mysqli_fetch_array($result);
                    echo '<tr><th>Community Name</th><th>Subject</th><th>Join?</th></tr>';
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>" . $row['comm_name'] . "</td>";
                        echo "<td>" . $row['comm_subject'] . "</td>";
                        echo "<td>Request to Join</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </center>
    </body>
</html>