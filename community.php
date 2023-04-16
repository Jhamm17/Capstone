<html>
    <head>
        <title>Community Home Page</title>
        <link rel="stylesheet" href="css/style.css">
        
    </head>
    <style>
        .tabledesign thead tr{
            background-color: blue;
            text-align: left;
            color: white;
        }
    </style>
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
    <div class="iu">
        <center><h1>Communities: </h1></center>
        <center><a href="createcommunity.php"><button class="comm">Create</button></a><a href="viewcommunities.php"><button class="comm">Your Communities</button></a></center>
        <center>
            <table class="tabledesign">
                <?php
                    $db = mysqli_connect("db.luddy.indiana.edu","i494f22_team36","my+sql=i494f22_team36","i494f22_team36") or die("Error connecting to MySQL server.");
                    if (mysqli_connect_errno()){
                        echo 'failed to connect to SQL';
                    }
                    $query1 = "SELECT * FROM community";
                    mysqli_query($db, $query1) or die('Error querying database.');
                    $result = mysqli_query($db, $query1);
                    $id = $_SESSION['user_id'];
                    $row = mysqli_fetch_array($result);
                    ?>
                    <tr><th class="commname">Community Name</th><th class="commsub">Subject</th><th class="commbio">Bio</th><th>Join?</th></tr>
                    <?php 
                    while($row = mysqli_fetch_array($result)){ ?>
                        <?php 
                        $commid = $row['comm_id'];
                        ?>
                        <tr>
                        <td><a href="NBAcommunity.php?id=<?php echo $commid; ?>"><?php echo $row['comm_name'];?></td>
                        <td><?php echo $row['comm_subject']; ?></td>
                        <td><?php echo $row['comm_bio']; ?></td>
                        <td><a href="viewcommunity.php?id=<?php echo $commid; ?>">Join</a></td>
                        <!-- // echo "<td><a href=\"NBAcommunity.php\">View</a></td>"; -->
                        </tr><?php
                    }
                ?>
            </table>
        </center>
    </div>
    <br>
    <!-- need to make community page show specific community-->
    </body>
</html>