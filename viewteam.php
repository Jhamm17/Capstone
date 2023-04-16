<html>
    <head>
        <title>View Team Page</title>
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
            <center>
            <br>
            <br>
            <?php
                $id = $_GET["id"];
                $new_query = "SELECT * FROM Teams WHERE Team_id='$id'";
                $result3 = mysqli_query($db, $new_query);
                while($row=mysqli_fetch_array($result3)){
                    echo 'Team Name: ' . $row["team_name"] . '<br>';
                }
            ?>
            <br>
        <table class="tabledesign">
            <?php
            $id = $_GET["id"];
            $db = mysqli_connect("db.luddy.indiana.edu","i494f22_team36","my+sql=i494f22_team36","i494f22_team36") or die("Error connecting to MySQL server.");
            if (mysqli_connect_errno()){
                echo 'failed to connect to SQL';
            }
            $query = "SELECT * FROM user JOIN team_rosters ON user.userid=team_rosters.Player_id WHERE Team_id='$id'";
            mysqli_query($db, $query) or die('Error querying database.');
            $result = mysqli_query($db, $query);
            echo "<h1>Team Roster</h1>";
            echo "<tr><th>Player Name</th><th>Email</th></tr>";
            while($row=mysqli_fetch_array($result)){
                echo '<tr>';
                echo '<td>' . $row["Fname"] . "  " . $row["Lname"] . " </td> ";
                echo '<td>' . $row["email"] . '</td>';
                echo '</tr>'; 
            }
        ?>
        </table></center>
    </body>
</html>