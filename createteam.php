<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
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
            $db = mysqli_connect("db.luddy.indiana.edu","i494f22_samanort","my+sql=i494f22_samanort","i494f22_samanort") or die("Error connecting to MySQL server.");
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
    </body>
</html>