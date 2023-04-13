<html>
    <head>
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
   <center> <div>
        <h2>Welcome to the College Football Community</h2>
        <h4>Check out some of the upcoming games and live scores in NCAA Football:</h4>
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
        $id = $_GET["id"];
        $query = "SELECT comm_subject FROM community WHERE comm_id='$id'";
        $sport = mysqli_query($conn, $query);
        echo $sport;
        $sql = "SELECT * FROM iulive WHERE sport='Football'";
        $result = mysqli_query($conn, $sql);

        // Check if there are any rows in the result set
        if (mysqli_num_rows($result) > 0) {
            // Output the data in a table
            echo "<table class='tabledesign'>";
            echo "<tr><th>Team 1</th><th>Score</th><th>Team 2</th><th>Time</th><th>Date</th><th>Team 1 Record</th><th>Team 1 Conference Record</th><th>Team 2 Conference Record</th><th>Team 2 Record</th><th>Period</th><th>Channel</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["Team1Name"] . "</td><td>" . $row["GameScore"] . "</td><td>" . $row["Team2Name"] . "</td><td>" . $row["GameTime"] . "</td><td>" . $row["GameDate"] . "</td>";
                echo "<td>" . $row["Team1Record"] . "</td><td>" . $row["Team1ConferenceRecord"] . "</td><td>" . $row["Team2ConferenceRecord"] . "</td><td>" . $row["Team2Record"] . "</td><td>" . $row["GamePeriod"] . "</td><td>" . $row["GameChannel"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No football game information found in the database.";
        }

        // Close the connection
        mysqli_close($conn);

        ?>
    </div><center>
        <br>
        <br>

    <center><iframe src="Page1.php" width="450" height="300" style="border: 5px solid black;" scrolling="yes"><center>
</iframe>
<form method="post" action="Page2.php">
<center>Make a post for the community to see: <input type="textarea" name="msg" /><center>
<input type="submit" value="Send" /> <br/> <br/> 
</form>

<style>
    input[type=submit] {
    padding:5px 15px; 
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 5px;
    border-radius: 5px; 
}
input[type=textarea] {
    padding:5px; 
    border:2px solid #ccc; 
    -webkit-border-radius: 5px;
    border-radius: 5px;
}