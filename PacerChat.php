<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PacerChat</title>
</head>
<link rel="stylesheet" href="css/styles.css">

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
        <a href="community.php">Community</a> 
        <a href="intramurals.php">Intramural Sports</a>    
        <a href="polls.php">Polls</a>
        <a href="profile2.php">Profile</a>
        <a href="https://idp.login.iu.edu/idp/profile/cas/logout">Log-Out </a>

    </div>
<br>

<center><h2>Chat</h2><center>
    <br>
<center><iframe src="Pacer1.php" width="450" height="300" style="border: 1px solid black;" scrolling="yes"><center>
</iframe>
<form method="post" action="Pacer2.php">
<center>Type message here: <input type="textarea" name="msg" /><center>
<input type="submit" value="Send" /> <br/> <br/> 
</form>

<div class="sidebar">
</div>

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
iframe:focus {
  outline: none;
}

iframe[seamless] {
  display: block;
}