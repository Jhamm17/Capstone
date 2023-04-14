<html>
    <head>
        <title>Community Create Page</title>
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
        <a href="community.php" class="round"> &#8249; </a>
        <style>
            a {
            text-decoration: none;
            display: inline-block;
            padding: 8px 16px;
            background-color: crimson;
            color: white;
            font-size: 30px;
            }

            a:hover {
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