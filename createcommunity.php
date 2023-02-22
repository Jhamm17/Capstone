<html>
    <head>
        <title>Community Create Page</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="topnav">
            <a href="home.html"><img class="homeImg" src="Images/homebutton.png" alt="Home"></a>
            <a href="cal.php">Calendar</a>
            <a href="chat.php">Chat</a> 
            <a href="community.php">Community</a> 
            <a href="intramurals.php">Intramural Sports</a> 
            <a href="live.html">IU Live</a>   
            <a href="polls.php">Polls</a>
            <a href="profile.php">Profile</a>
            <a href="https://idp.login.iu.edu/idp/profile/cas/login?service=https://cgi.luddy.indiana.edu/~team36/loign.php">Log-In</a> 
        </div>
        <h1>Create a Community!<h1>
        <form name="commcreate" method="POST" action="">
            <label for="commname">Community Name</label>
            <input type="text" name="commname"></input><br>
            <label for="commsub">Subject</label>
            <input type="text" name="commsub"></input><br>
            <label for="commbio">Bio</label>
            <input type="text" name="commbio"></input>
            <label for="commprivacy">Privacy</label>
            <select name="commprivacy" id="commprivacy">
                <option value="private">Private</option>
                <option value="public">Public</option><br>
            <input type="submit" value="submit" name="submit">
        </form>
        <?php 
            $db = mysqli_connect("db.luddy.indiana.edu","i494f22_samanort","my+sql=i494f22_samanort","i494f22_samanort") or die("Error connecting to MySQL server.");
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