<html>
<head>
<title>Sign Up</title>
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
        <a href="profile.php">Profile</a>
        <a href="https://idp.login.iu.edu/idp/profile/cas/login?service=https://cgi.luddy.indiana.edu/~team36/loign.php">Log-In</a> 
</div>

<form action="signup.php" method="post">
First Name: <input type="text" name="fname"><br><br>
Last Name: <input type="text" name="lname"><br><br>
Password: <input type="password" name="password"><br><br>
Confirm Password: <input type="password" name="confirm_password"><br><br>
Email: <input type="email" name="email"><br><br>
<input type="submit" value="Sign Up">
</form>

</body>
</html>

<?php
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

if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['email'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    
    if($password == $confirm_password){
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO user (Fname, Lname, password, email)
        VALUES ('$Fname', '$Lname', '$password', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "Sign up successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else{
        echo "Password and Confirm Password do not match";
    }
}

$conn->close();
?>
