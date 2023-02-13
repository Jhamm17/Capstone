
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
        <a href="chat.php">Chat</a> 
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

    
    // Define the query to retrieve 6 polls from the database
    $sql = "SELECT * FROM polls LIMIT 6";

    // Get the IDs of the polls the user has already voted in
    $voted_polls = isset($_COOKIE['voted_polls']) ? json_decode($_COOKIE['voted_polls'], true) : [];

    // Display the polls
    if ($result->num_rows > 0) {
        // Output data for each row
        while($row = $result->fetch_assoc()) {
            echo "<form action='submit_response.php' method='post'>";
            echo "<h3>" . $row["question"] . "</h3>";

            // Retrieve the count of votes for each answer
            $answer_1_sql = "SELECT COUNT(*) FROM poll_responses WHERE poll_id = " . $row["id"] . " AND answer = '" . $row["answer_1"] . "'";
            $answer_1_result = $conn->query($answer_1_sql);
            $answer_1_count = $answer_1_result->fetch_row()[0];

            $answer_2_sql = "SELECT COUNT(*) FROM poll_responses WHERE poll_id = " . $row["id"] . " AND answer = '" . $row["answer_2"] . "'";
            $answer_2_result = $conn->query($answer_2_sql);
            $answer_2_count = $answer_2_result->fetch_row()[0];

            // Check if the user has already voted in this poll
            if (in_array($row["id"], $voted_polls)) {
                // Display the count of votes next to each answer
                echo $row["answer_1"] . " (" . $answer_1_count . " votes)<br>";
                echo $row["answer_2"] . " (" . $answer_2_count . " votes)<br>";
                echo "You have already voted in this poll.<br>";
            } else {
                // Display the count of votes next to each answer and the voting options
                echo "<input type='radio' name='answer' value='" . $row["answer_1"] . "'>" . $row["answer_1"] . " (" . $answer_1_count . " votes)<br>";
                echo "<input type='radio' name='answer' value='" . $row["answer_2"] . "'>" . $row["answer_2"] . " (" . $answer_2_count . " votes)<br>";
                echo "<input type='hidden' name='poll_id' value='" . $row["id"] . "'>";
            }
        }
    }
    // Close the database connection
    $conn->close();
    ?>

</container>
</body>
</html>



