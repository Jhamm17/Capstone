<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>send message</title>
</head>
<link rel="stylesheet" href="css/styles.css">


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
<br>
<br>
<center><iframe src="Page1.php" width="450" height="300" style="border: 5px solid black;" scrolling="yes"><center>
</iframe>
<form method="post" action="Page2.php">
<center>Send user a message: <input type="textarea" name="msg" /><center>
<input type="submit" value="Send" /> <br/> <br/> 
</form>

<style>
    input[type=submit] {
    padding:5px 15px; 
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 5px;
    border-radius: 5px; 
}
input[type=textarea] {
    padding:5px; 
    border:2px solid #ccc; 
    -webkit-border-radius: 5px;
    border-radius: 5px;
}

</style>
</body>  
</html>