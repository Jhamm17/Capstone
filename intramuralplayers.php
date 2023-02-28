<html>
    <head>
        <title></title>
    </head>
    <link rel="stylesheet" href="css/style.css">
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
        <h1><center>Intramural Player Search Page!</center></h1>
        <center><table class="tabledesign">
            <?php
                // $db = mysqli_connect("db.luddy.indiana.edu","i494f22_team36","my+sql=i494f22_team36","i494f22_team36") or die("Error connecting to MySQL server.");
                // if (mysqli_connect_errno()){
                //     echo 'failed to connect to SQL';
                // }
                $servername = "db.luddy.indiana.edu";
                $username = "i494f22_team36";
                $password = "my+sql=i494f22_team36";
                $dbname = "i494f22_team36";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                // $query1 = "SELECT * FROM Intramurals";
                $query1 = "SELECT i.Preferred_sport, i.On_team, i.user_email, i.player_id, 
                  CONCAT('player_profile.php?email=', i.user_email) AS profile_url, 
                  u.Fname, u.Lname
                FROM Intramurals i
                JOIN user u ON i.user_email = u.email";
                mysqli_query($conn, $query1) or die('Error querying database.');
                $result = mysqli_query($conn, $query1);

                echo '<tr><th>Player Name</th><th>Preferred Sport</th><th>On Team?</th><th>Contact Me</th></tr>';
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row['Fname'] . " " . $row['Lname'] . "</td>";
                    echo "<td>" . $row['Preferred_sport'] . "</td>";
                    echo "<td>" . $row['On_team'] . "</td>";
                    echo "<td><a href='" . $row['profile_url'] . "'>" . "Profile" . "</a></td>";
                    echo "</tr>";
                }

                mysqli_close($conn);
            ?>
        </table></center>
    </body>
</html>