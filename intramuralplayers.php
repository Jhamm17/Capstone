<html>
    <head>
        <title></title>
    </head>
    <link rel="stylesheet" href="css/style.css">
    <body>
    <div class="topnav">
        <a href="home.html"><img class="homeImg" src="Images/homebutton.png" alt="Home"></a>
        <a href="calendar.php">Calendar</a>
        <a href="chat.html">Chat</a> 
        <a href="community.html">Community</a> 
        <a href="intramurals.php">Intramural Sports</a> 
        <a href="live.html">IU Live</a>   
        <a href="polls.php">Polls</a>
        <a href="profile2.php">Profile</a>
        <a href="https://idp.login.iu.edu/idp/profile/cas/login?service=https://cgi.luddy.indiana.edu/~team36/loign.php">Log-In</a> 
        <a href="https://idp.login.iu.edu/idp/profile/cas/logout">Log-Out </a>

    </div>
        <h1><center>Intramural Player Search Page!</center></h1>
        <center><table class="tabledesign">
            <?php
                $db = mysqli_connect("db.luddy.indiana.edu","i494f22_samanort","my+sql=i494f22_samanort","i494f22_samanort") or die("Error connecting to MySQL server.");
                if (mysqli_connect_errno()){
                    echo 'failed to connect to SQL';
                }
                // $query1 = "SELECT * FROM Intramurals";
                $query1 = "SELECT Preferred_sport, On_team, user_email, player_id, CONCAT('player_profile.php?email=', user_email) AS profile_url FROM Intramurals";
                mysqli_query($db, $query1) or die('Error querying database.');
                $result = mysqli_query($db, $query1);
                $row = mysqli_fetch_array($result);

                echo '<tr><th>Preferred Sport</th><th>On Team?</th><th>Contact Me</th></tr>';
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row['Preferred_sport'] . "</td>";
                    echo "<td>" . $row['On_team'] . "</td>";
                    // echo "<td>" . $row['user_email'] . "</td>";
                    echo "<td><a href='" . $row['profile_url'] . "'>" . "Profile" . "</a></td>";
                    echo "</tr>";
                }
                mysqli_close($db);
            ?>
        </table></center>
    </body>
</html>