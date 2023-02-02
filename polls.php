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
        $query = "SELECT * FROM polls WHERE pollID='$pollID'";
        $q = mysqli_query($connect, $query);
        echo mysqli_num_rows($q);
        
        while($row = mysqli_fetch_array($q)) {
            $id = $row[0];
            $title = $row[1];
            $pollID = $row[2];
            $userID = $row[3];
            echo "<h1>$title</h1>";
        }
        ?>
        <table>
                <form action="" method="POST">
            <?php
                $questions = "SELECT * FROM questions WHERE pollID='$pollID'";
                $q2 = mysqli_query($connect, $questions);
                while($r = mysqli_fetch_array($q2)) {
                $question = $r[1];
                $votes = $r[2];
                $newvotes = $votes + 1;
                $newuserID = $userID."$userID,";

                if (isset($_POST['vote'])) {
                    $polloption = $_POST['polloption'];
                    if ($polloption == "") {
                        die("You didn't select an option.");
                    } else {
                        mysqli_query($connect, "UPDATE questions SET votes = '$newvotes', userID='$userID' WHERE pollID='$pollID' AND question='$polloption'")
                        mysqli_query($connect, "UPDATE polls SET userID='$newuserID' WHERE pollID='$pollID'");
                        die("You voted Successfully");
                    }
                }
                echo '<tr><td>'.$question.'</td><td><input type="radio" name="polloption" value="'.$question.'" /> '.$votes.' votes</td></tr>';
                }

        }
        ?>
        <tr><td><input type="submit" name="vote" value="Vote" /></td></tr>
            </form>
            </table>
    </container>
</body>
</html>