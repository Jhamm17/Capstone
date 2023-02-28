<html>
    <head>
        <title>Community Create Page</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="topnav">
            <a href="homepage.php"><img class="homeImg" src="Images/homebutton.png" alt="Home"></a>
            <a href="calendar.php">Calendar</a>
            <a href="chat.php">Chat</a> 
            <a href="community.php">Community</a> 
            <a href="intramurals.php">Intramural Sports</a> 
            <a href="live.html">IU Live</a>   
            <a href="polls.php">Polls</a>
            <a href="profile.php">Profile</a>
            <a href="https://idp.login.iu.edu/idp/profile/cas/login?service=https://cgi.luddy.indiana.edu/~team36/loign.php">Log-In</a> 
        </div>
        <center><h1>Create a Community!<h1></center>
        <center><form name="commcreate" method="POST" action="">
            <label for="commname">Community Name</label>
            <input type="text" name="commname"></input><br><br>
            <label for="commsub">Subject</label>
            <input type="text" name="commsub"></input><br><br>
            <label for="commbio">Bio</label>
            <input type="text" name="commbio"></input><br><br>
            <label for="commprivacy">Privacy</label>
            <select name="commprivacy" id="commprivacy">
                <option value="private">Private</option>
                <option value="public">Public</option><br><br>
            <input type="submit" value="submit" name="submit">
        </form></center>
        <?php 
            $db = mysqli_connect("db.luddy.indiana.edu","i494f22_team36","my+sql=i494f22_team36","i494f22_team36") or die("Error connecting to MySQL server.");
            if(isset($_POST['submit'])){
                $commname = $_REQUEST["commname"];
                $commsub = $_REQUEST["commsub"];
                $commbio = $_REQUEST["commbio"];
                $commprivacy = $_REQUEST["commprivacy"];
            }
            $insertquery = "INSERT INTO community(comm_name, comm_subject, comm_bio, privacy) VALUES ('$commname', '$commsub', '$commbio', '$commprivacy')";
            if(isset($_POST['submit'])){
                if(mysqli_query($db, $insertquery)){
                    echo "data stored successfully";
                }else{
                    echo "data was unable to be stored";
                }
            }
            mysqli_close($db);
        ?>
    </body>
</html>