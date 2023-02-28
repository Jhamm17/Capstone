<html>
    <head>
        <title>Community Home Page</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
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
        <center><h1>Communities: </h1></center>
        <center><a href="createcommunity.php"><button class="comm">Create</button></a><a href="viewcommunities.php"><button class="comm">Your Communities</button></a></center>
        <center>
            <table class="tabledesign">
                <?php
                    $db = mysqli_connect("db.luddy.indiana.edu","i494f22_team36","my+sql=i494f22_team36","i494f22_team36") or die("Error connecting to MySQL server.");
                    if (mysqli_connect_errno()){
                        echo 'failed to connect to SQL';
                    }
                    $query1 = "SELECT * FROM community";
                    mysqli_query($db, $query1) or die('Error querying database.');
                    $result = mysqli_query($db, $query1);
                    $row = mysqli_fetch_array($result);
                    echo '<tr><th>Community Name</th><th>Subject</th><th>Bio</th><th>Join?</th></tr>';
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>" . $row['comm_name'] . "</td></a>";
                        echo "<td>" . $row['comm_subject'] . "</td>";
                        echo "<td>" . $row['comm_bio'] . "</td>";
                        echo "<td><a href=\"viewcommunity.php?id=" . $row['comm_id'] . "\">Join</a></td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </center>
    </body>
</html>