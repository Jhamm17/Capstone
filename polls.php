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
    <!-- Link to JavaScript -->
    <script src="main.js"></script>
</head>
<body>
    <div class="topnav"> 
        <a href="homepage.php"><img class="homeImg" src="Images/homebutton.png" alt="Home"></a>
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
        <div>
            <h1 class="polls-title-h1"> Polls </h1>
        </div>
    </container>
    <container class="polls-content">
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
        // Check if the user has already voted for this poll
        $user_id = $_SESSION['user_id'];
        $email = trim($_SESSION['email']);
        $poll_id = $_POST["poll_id"];
        $sql = "SELECT * FROM poll_responses WHERE poll_id = $poll_id";
        $sql .= " AND user_id = $user_id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "You have already voted in this poll.";
        } else {
            // Store the user's response in the database
            $poll_id = $_POST["poll_id"];
            $answer = $_POST["answer"];
            $sql = "INSERT INTO poll_responses (user_id, poll_id, answer) VALUES ($user_id, $poll_id, '$answer')";


            if ($conn->query($sql) === TRUE) {
                echo "Your vote has been recorded. Thank you for participating!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }


    // Define the query to retrieve 6 polls from the database
    $sql = "SELECT * FROM polls LIMIT 6";

    // Execute the query
    $result = $conn->query($sql);

    echo "<div class='wrapper'>";
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

            $percent_total = ($answer_1_count + $answer_2_count);
            $percent1 = (($answer_1_count / $percent_total) * 100);
            $percent2 = (($answer_2_count / $percent_total) * 100);
            $percent1_answer = (round($percent1));
            $percent2_answer = (round($percent2));

            echo "<form action='#' method='post' class='poll-area'>";
            echo "<input type='checkbox' name='answer_" . {$row['id']} . "' id='opt-1' value='" . $row["answer_1"] . "'>";
                echo "<label for='opt-1' class='opt-1'>";
                    echo "<div class='row'>";
                    echo "<div class='column'>";
                        echo "<span class='circle'></span>";
                        echo "<span class='text'>" . $row["answer_1"] . "</span>";
                    echo "</div>";
                    echo "<span class='percent'>(" . $percent1_answer . ")%</span>";
                    echo "</div>";
                    echo "<div class='progress' style='--w:" . $percent1_answer . ";'></div>";
                echo "</label>";
                echo "<input type='checkbox' name='answer_" . {$row['id']} . "' id='opt-2' value='" . $row["answer_2"] . "'>";
                echo "<label for='opt-2' class='opt-2'>";
                    echo "<div class='row'>";
                    echo "<div class='column'>";
                        echo "<span class='circle'></span>";
                        echo "<span class='text'>" . $row["answer_2"] . "</span>";
                    echo "</div>";
                    echo "<span class='percent'>(" . $percent2_answer . ")%</span>";
                    echo "</div>";
                    echo "<div class='progress' style='--w:" . $percent2_answer . ";'></div>";
                echo "</label>";
                echo "<input type='hidden' name='poll_id' value='" . $row["id"] . "'>";
                echo "<input type='submit' name='submit' value='Vote' class='vote-button'>";
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
</body>
</html>
