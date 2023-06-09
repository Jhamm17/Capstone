<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <?php
    session_start();
    if(!$_SESSION['authenticated']){
        header('Location: homelogin.php');
    }
    ?>
    <body>
    <div class="topnav"> 
        <a href="homepage.php"><img class="homeImg" src="Images/smallLogo.png" alt="Home"></a>
        <a href="calendar.php">Calendar</a>
        <a href="community.php">Community</a> 
        <a href="intramurals.php">Intramural Sports</a>    
        <a href="polls.php">Polls</a>
        <a href="profile2.php">Profile</a>
        <a href="https://idp.login.iu.edu/idp/profile/cas/logout">Log-Out </a>
    </div>
        <h1><center>Intramural Team Search Page!</center></h1>
        <!-- select form to allow user to filter through intramural teams -->
        <center><form name="teamfilter" method="POST" action="">
            <select name="leaguefilter" id="leaguefilter">
                <option value="Casual">Casual</option>
                <option value="Competitive">Competitive</option>
                <!-- <option value="Casual' OR League='Competitive">All</option> -->
            </select>
            <select name="sportfilter" id="sportfilter">
                <option value="Basketball">Basketball</option>
                <option value="Baseball">Baseball</option>
                <option value="Football">Football</option>
                <option value="Soccer">Soccer</option>
                <option value="Badminton">Badminton</option>
                <option value="Basketball' OR Sport='basketball' OR Sport='Baseball' OR Sport='baseball' OR Sport='Football' OR Sport='football' OR Sport='Soccer' OR Sport='soccer' OR Sport='Badminton' OR Sport='badminton">All</option>
            </select>
            <input type="submit" value="submit" name="submit"></input>
        </form></center>
        <!-- php to pull data specified from the user, essentially a filter option -->
        <center><table class="tabledesign">
            <?php
                $db = mysqli_connect("db.luddy.indiana.edu","i494f22_team36","my+sql=i494f22_team36","i494f22_team36") or die("Error connecting to MySQL server.");
                if (mysqli_connect_errno()){
                    echo 'failed to connect to SQL';
                }
                echo '<tr><th>Team Name</th><th>Sport</th><th>League</th><th>Number of Players</th><th>View Team</th></tr>';
                if(isset($_POST["submit"])){
                    $league = $_REQUEST["leaguefilter"];
                    $sport = $_REQUEST["sportfilter"];
                    $query1 = "SELECT * FROM Teams WHERE Sport='$sport' and League='$league'";
                    mysqli_query($db, $query1) or die('Error querying database.');
                    $result = mysqli_query($db, $query1); 
                    
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>" . $row['team_name'] . "</td>";
                        echo "<td>" . $row['Sport'] . "</td>";
                        echo "<td>" . $row['League'] . "</td>";
                        echo "<td>" . $row['Num_players'] . "</td>";
                        echo "<td><a href=\"viewteam.php?id=" . $row['Team_id'] . "\">View</a></td>";
                        echo "</tr>";
                    }
                }else{
                    $query1 = "SELECT * FROM Teams";
                    mysqli_query($db, $query1) or die('Error querying database.');
                    $result = mysqli_query($db, $query1);
                    $row = mysqli_fetch_array($result);
                    
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>" . $row['team_name'] . "</td>";
                        echo "<td>" . $row['Sport'] . "</td>";
                        echo "<td>" . $row['League'] . "</td>";
                        echo "<td>" . $row['Num_players'] . "</td>";
                        echo "<td><a href=\"viewteam.php?id=" . $row['Team_id'] . "\">View</a></td>";
                        echo "</tr>";
                    }
                }
                mysqli_close($db);
            ?>
        </table></center>
        <a href="intramurals.php" class="round"> &#8249; </a>
        <style>
            a {
            text-decoration: none;
            display: inline-block;
            padding: 8px 14px;
            background-color: #990000;
            color: white;
            font-size: 30px;
            }

            .round:hover {
            background-color: black;
            color: white;
            }

            .round {
            border-radius: 50%;
            position: fixed;
            bottom: 0px;
            left: 0px; 
            padding: 20px;
            }
            
        </style>
    </body>
</html>