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
        <a href="community.php">Community</a> 
        <a href="intramurals.php">Intramural Sports</a>    
        <a href="polls.php">Polls</a>
        <a href="profile2.php">Profile</a>
        <a href="https://idp.login.iu.edu/idp/profile/cas/logout">Log-Out </a>
    </div>
   <center> <div>
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
        $row1 = mysqli_fetch_array($sport);
        $comm_sport = $row1[0];
        $sql = "SELECT * FROM iulive WHERE sport='$comm_sport'";
        $result = mysqli_query($conn, $sql);

        echo "<h2>Welcome to the $comm_sport Community</h2>";
        echo "<h4>Check out some of the upcoming games and live scores in $comm_sport:</h4>";

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
            echo "No $comm_sport game information found in the database.";
        }

        // Close the connection
        mysqli_close($conn);

        ?>
    </div><center>
        <br>
        <br>

<center><iframe src="Pacer1.php" width="450" height="300" style="border: 1px solid black;" scrolling="yes"><center>
</iframe>
<form method="post" action="">
<center>Make a post for the community to see: <input type="textarea" name="msg" /><center>
<input type="submit" value="Send" /> <br/> <br/> 
</form>
<?php
if(isset($_POST['send'])){
    $user_id = $_SESSION['user_id'];
    $msg = $_POST['msg'];
    $msg_data = [
        'msg' => $msg,
    ]
    $sending = "INSERT INTO PacerChat (id,msg) VALUES ('$user_id','$msg')";
    mysqli_query($conn, $sending);


}

?>

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