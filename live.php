<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Social</title>
    <!-- resets browser defaults -->
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
     <!-- link to Font Awesome icon font -->
     <script src="https://kit.fontawesome.com/bf37eaf948.js" crossorigin="anonymous"></script>
    <!-- custom styles -->
    <link rel="stylesheet" type="text/css" href="css/iulive.css">
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

    <container class="polls-title">
        <div class="dropdown">
            <button class="dropbtn">Sports</button>
            <div class="dropdown-content">
                <a href="live.php">Football</a>
                <a href="livebb.php">Men's Basketball</a>
            </div>
        </div>
        <div>
            <h1 class="polls-title-h1"> IU Live </h1>
        </div>
        <div>
            <form action="polls.php">
                <button class="leaderboard"> Vote Who Will Win </button>
            </form>    
        </div>
    </container>

    <container>
        <?php

        // Connect to the database
        $servername = "db.luddy.indiana.edu";
        $username = "i494f22_team36";
        $password = "my+sql=i494f22_team36";
        $dbname = "i494f22_team36";

        // Create a connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Select all rows from the "iulive" table where the sport is football
        $sql = "SELECT * FROM iulive1 WHERE Sport='MLB'";
        $result = mysqli_query($conn, $sql);

        // Check if there are any rows in the result set
        if (mysqli_num_rows($result) > 0) {
            // Output the data in a table
            while ($row = mysqli_fetch_assoc($result)) {
                $gameScore = $row["GameScore"];
				$team1Name = $row["Team1Name"];
				$team2Name = $row["Team2Name"];

				// Display game data in scoreboard
				echo "<div class='scoreboard-grid'>
                        <div class='scoreboard'>
                            <div class='team'>$team1Name</div>
                            <div class='score'>$gameScore</div>
                            <div class='team'>$team2Name</div>
                        </div>
                    </div>";
            }
        } else {
            echo "No MLB games yesterday";
        }

        // Close the connection
        mysqli_close($conn);

        ?>
    </container>
    </body>
</html>