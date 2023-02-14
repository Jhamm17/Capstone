<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="css/styles.css">

<body>
    <div class="topnav">
        <a href="home.html"><img class="homeImg" src="Images/homebutton.png" alt="Home"></a>
        <a href="calendar.php">Calendar</a>
        <a href="chat.php">Chat</a> 
        <a href="community.html">Community</a> 
        <a href="intramurals.php">Intramural Sports</a> 
        <a href="live.html">IU Live</a>   
        <a href="polls.php">Polls</a>
        <a href="profile2.php">Profile</a>
        <a href="https://idp.login.iu.edu/idp/profile/cas/login?service=https://cgi.luddy.indiana.edu/~team36/loign.php">Log-In</a> 
    </div>

    <h3>Login</h3>
    <form action="" method="POST">
        First Name: <input type="text" name="Fname" required><br>
        Last Name: <input type="text" name="Lname" required><br>
        email: <input type="text" name="email" required><br>

        <button type="submit" name="login">submit</button>
    </form>

    <?php
$servername = "db.luddy.indiana.edu";
$username = "i494f22_team36";
$password = "my+sql=i494f22_team36";
$dbname = "i494f22_team36";

// Connect to the database
$con = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login'])){
    $flag = 1;
    $fname = test_input($_POST["Fname"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
        $fnameErr = "Only letters and white space allowed";
        echo $fnameErr;
        $flag = 0;
    }    
    echo '<br>';
    $lname = test_input($_POST["Lname"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
        $lnameErr = "Only letters and white space allowed";
        echo $lnameErr;
        $flag = 0;
    }
    echo '<br>';
    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        echo $emailErr;
        $flag = 0;
    }

    $duplicate = "SELECT * FROM user WHERE email='$email'";
    $dupe = mysqli_query($con, $duplicate);

    if ($flag == 1 AND mysqli_num_rows($dupe) > 0) {
        $stmt = mysqli_prepare($con, "INSERT INTO user (Fname, Lname, email) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $fname, $lname, $email);
        if (mysqli_stmt_execute($stmt)) {
            echo "Record added successfully";
        } else {
            echo "Error adding record: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    }
}
    
