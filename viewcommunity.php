<html>
    <head>
        <title>View Community Page</title>
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
            <a href="chat.php">Chat</a> 
            <a href="community.php">Community</a> 
            <a href="intramurals.php">Intramural Sports</a> 
            <a href="live.php">IU Live</a>   
            <a href="polls.php">Polls</a>
            <a href="profile2.php">Profile</a>
            <a href="https://idp.login.iu.edu/idp/profile/cas/logout">Log-Out </a>
        </div>
        <center>
            <br>
            <br>
            <br>
        <table class="tabledesign">
            <?php
            $id = $_GET["id"];
            $db = mysqli_connect("db.luddy.indiana.edu","i494f22_team36","my+sql=i494f22_team36","i494f22_team36") or die("Error connecting to MySQL server.");
            if (mysqli_connect_errno()){
                echo 'failed to connect to SQL';
            }
            $query = "SELECT * FROM community INNER JOIN community_people ON community.comm_id=community_people.Comm_id INNER JOIN user ON user.userid=community_people.Person_id WHERE community.comm_id='$id'";
            mysqli_query($db, $query) or die('Error querying database.');
            $result = mysqli_query($db, $query);
            echo "<h1>People within the Community</h1>";
            echo "<tr><th>Name</th><th>Email</th></tr>";
            while($row=mysqli_fetch_array($result)){
                echo '<tr>';
                echo '<td>' .  $row["Fname"] . '  ' . $row["Lname"] . '</td>';
                echo '<td>' . $row["email"] . '</td>';
                echo '</tr>';
            }
        ?>
        </table></center>
        <center>
            <!-- <form action="" method="POST">
                <input type="submit" name="submit" value="submit"></input></center>
            </form> -->
        <a class="editprofilebutton" href="NBAcommunity.php">Join Community!</a>

        <?php
            $userid = $_SESSION['user_id'];
            $commid = $_GET["id"];
            if(isset($_POST["submit"])){ 
                $newquery = "INSERT IGNORE INTO community_people VALUES ('$commid', '$userid')";
                if(mysqli_query($db, $newquery)){
                    echo "You have successfully joined the community!";
                }
                else{
                    echo "Unable to join the community";
                }
            }
            mysqli_close($db);
        ?>
    </body>
</html>