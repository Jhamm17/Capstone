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
        <a href="calendar.php">Calendar</a>
        <a href="chat.php">Chat</a> 
        <a href="community.php">Community</a> 
        <a href="intramurals.php">Intramural Sports</a> 
        <a href="live.php">IU Live</a>   
        <a href="polls.php">Polls</a>
        <a href="profile2.php">Profile</a>
        <a href="https://idp.login.iu.edu/idp/profile/cas/login?service=https://cgi.luddy.indiana.edu/~team36/loign.php">Log-In</a> 
        <a href="https://idp.login.iu.edu/idp/profile/cas/logout">Log-Out </a>

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
    <container>
    <?php

    session_start();

    $servername = "db.luddy.indiana.edu";
    $username = "i494f22_team36";
    $password = "my+sql=i494f22_team36";
    $dbname = "i494f22_team36";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // Check if the form has been submitted
    if (isset($_POST["submit"])) {
        // Check if the user has already voted
        if (!isset($_SESSION["voted"])) {
            // Store the user's response in the database
            $poll_id = $_POST["poll_id"];
            $answer = $_POST["answer"];
            $sql = "INSERT INTO poll_responses (poll_id, answer) VALUES ($poll_id, '$answer')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION["voted"] = true;
                echo "Your vote has been recorded. Thank you for participating!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "You have already voted.";
        }
    }

    // Define the query to retrieve 6 polls from the database
    $sql = "SELECT * FROM polls LIMIT 6";

    // Execute the query
    $result = $conn->query($sql);

    echo "<container class='wrapper'>";
    // Check if the query returned any results
    if ($result->num_rows > 0) {
        // Loop through the result set and display each poll
        while($row = $result->fetch_assoc()) {
            echo "<h3>" . $row["question"] . "</h3>";
            // Retrieve the count of votes for each answer
            $answer_1_sql = "SELECT COUNT(*) FROM poll_responses WHERE poll_id = " . $row["id"] . " AND answer = '" . $row["answer_1"] . "'";
            $answer_1_result = $conn->query($answer_1_sql);
            $answer_1_count = $answer_1_result->fetch_row()[0];

            $answer_2_sql = "SELECT COUNT(*) FROM poll_responses WHERE poll_id = " . $row["id"] . " AND answer = '" . $row["answer_2"] . "'";
            $answer_2_result = $conn->query($answer_2_sql);
            $answer_2_count = $answer_2_result->fetch_row()[0];
            echo "<form action='#' method='post' class='poll-area'>";
                echo "<input type='radio' name='answer' id='opt-1' value='" . $row["answer_1"] . "'>";
                echo "<label for='opt-1' class='opt-1'>";
                    echo "<div class='row'>";
                    echo "<div class='column'>";
                        echo "<span class='circle'></span>";
                        echo "<span class='text'>" . $row["answer_1"] . "</span>";
                    echo "</div>";
                    echo "<span class='percent'>(" . $answer_1_count . " votes)</span>";
                    echo "</div>";
                    echo "<div class='progress' style='--w:30;'></div>";
                echo "</label>";
                echo "<input type='radio' name='answer' id='opt-2' value='" . $row["answer_2"] . "'>";
                echo "<label for='opt-2' class='opt-2'>";
                    echo "<div class='row'>";
                    echo "<div class='column'>";
                        echo "<span class='circle'></span>";
                        echo "<span class='text'>" . $row["answer_2"] . "</span>";
                    echo "</div>";
                    echo "<span class='percent'>(" . $answer_2_count . " votes)</span>";
                    echo "</div>";
                    echo "<div class='progress' style='--w:30;'></div>";
                echo "</label>";
                echo "<input type='hidden' name='poll_id' value='" . $row["id"] . "'>";
                echo "<input type='submit' name='submit' value='Vote'>";
            echo "</form>";
        }
    } else {
        echo "No polls found.";
    }
    echo "</div>";
    // Close the database connection
    $conn->close();
    ?>


</container>
<script src="main.js"></script>
</body>
</html>
