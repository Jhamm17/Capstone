<html>
    <head>
        <title></title>
    </head>
    <link rel="stylesheet" href="css/style.css">
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
        <h1><center>Intramural Create Team Page!</center></h1>
        <center><form name="teamcreate" method="POST" action="">
            <label for="teamname">Team Name: </label>
            <input type="text" name="teamname"></input><br><br>
            <label for="sport">Sport: </label>
            <input type="text" name="sport"></input><br><br>
            <label for="numplayers">Player amount: </label>
            <input type="number" name="numplayers"></input><br><br>
            <label for="league">League: </label>
            <select name="league" id="league"><br>
                <option value="Competitive">Competitive</option>
                <option value="Casual">Casual</option>
                <option value="Rec">Rec</option><br><br>
            <br><input type="submit" name="submit" value="submit">
        </form></center>
        <?php 
            $db = mysqli_connect("db.luddy.indiana.edu","i494f22_team36","my+sql=i494f22_team36","i494f22_team36") or die("Error connecting to MySQL server.");
            if(isset($_POST['submit'])){
                $teamname = $_REQUEST["teamname"];
                $sport = $_REQUEST["sport"];
                $numplayers = $_REQUEST["numplayers"];
                $league = $_REQUEST["league"];
            }
            $insertquery = "INSERT INTO Teams(team_name, Sport, League, Num_players) VALUES ('$teamname', '$sport', '$league', '$numplayers')";
            if(isset($_POST['submit'])){
                if(isset($teamname)){
                    if(isset($numplayers)){
                        if(isset($league)){
                            if(isset($sport)){
                                if(mysqli_query($db, $insertquery)){
                                    echo "data stored successfully";
                                }else{
                                    echo "data was unable to be stored";
                                }
                            }
                        }
                    }
                }
            }
            mysqli_close($db);
        ?>
         <a href="intramurals.php" class="round"> &#8249; </a>
        <style>
            a {
            text-decoration: none;
            display: inline-block;
            padding: 8px 14px;
            background-color: #990000;
            color: white;
            font-size: 30px;
            }

            .round:hover {
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