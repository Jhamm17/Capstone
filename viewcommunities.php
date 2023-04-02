<html>
    <head>
        <title>Community View Page</title>
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
        <h1>Community view </h1>
        <center>
            <table class="tabledesign">
                <?php
                    $db = mysqli_connect("db.luddy.indiana.edu","i494f22_team36","my+sql=i494f22_team36","i494f22_team36") or die("Error connecting to MySQL server.");
                    if (mysqli_connect_errno()){
                        echo 'failed to connect to SQL';
                    }
                    $id = $_SESSION['user_id'];
                    $query1 = "SELECT * FROM community WHERE Person_id='$id'";
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