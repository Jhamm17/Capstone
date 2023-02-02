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
    <link rel="stylesheet" type="text/css" href="css/polls.css">
</head>
<body>
    <div class="topnav"> 
        <a href="home.html"><img class="homeImg" src="Images/homebutton.png" alt="Home"></a>
        <a href="cal.php">Calendar</a>
        <a href="chat.html">Chat</a> 
        <a href="community.html">Community</a> 
        <a href="intramurals.php">Intramural Sports</a> 
        <a href="live.html">IU Live</a>   
        <a href="polls.php">Polls</a>
        <a href="profile.html">Profile</a>
        <a href="loign.php">Log-In</a> 
    </div>

    <container class="polls-title">
        <div class="dropdown">
            <button class="dropbtn">Sports</button>
            <div class="dropdown-content">
                <a href="#">Football</a>
                <a href="#">Women's Basketball</a>
                <a href="#">Men's Basketball</a>
                <a href="#">Volleyball</a>
                <a href="#">Soccer</a>
            </div>
        </div>
        <div>
            <h1 class="polls-title-h1"> Polls </h1>
        </div>
        <div>
            <button class="leaderboard"> Leaderboard </button>
        </div>
    </container>
    <container class="polls-vote">
        <?php
        $con = mysqli_connect("db.luddy.indiana.edu","i494f22_team36","my+sql=i494f22_team36","i494f22_team36");

        if ($con->connect_error) {
            die("connection failed: " . $con->connect_error);
        }

        $pollID = $_GET['pollID'];
        echo $_POST['polloption'];
        $query = "SELECT & FROM polls WHERE pollID='$pollID'";
        $q = mysql_query($connect, $query);
        echo mysql_num_rows($q);
        
        while($row = mysql_fetch_array($q)) {
            $id = $row[0];
            $title = $row[1];
            $pollID = $row[2];
            $userID = $row[3];
            echo "<h1>$title</h1>";
        ?>
    </container>
</body>
</html>