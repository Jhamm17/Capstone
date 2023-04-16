<html>
    <head>
        <title>Intramural Page</title>
    </head>
    <?php
    session_start();
    if(!$_SESSION['authenticated']){
        header('Location: homelogin.php');
    }
    ?>
    <link rel="stylesheet" href="css/style.css">
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
        <h1><center>Intramural Home Page!</center></h1>
        <div>
            <center>
            <a href="createteam.php">
                <button>CREATE A TEAM</button>
            </a>
            <a href="teamsearch.php">
                <button>JOIN A TEAM</button>
            </a>
            <a href="intramuralplayers.php">
                <button>PLAYER SEARCH</button>
            </a>
            </center>
        </div>
        
    </body>
</html>
