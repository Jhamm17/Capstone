<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css">
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
    <br>
    <h3>Login</h3>
    <form action="insert.php" method="POST">
        First Name: <input type="text" name="Fname" required><br>
        Last Name: <input type="text" name="Lname" required><br>
        email: <input type="text" name="email" required><br>
        <button type="submit" name="login">submit</button>
    </form>
    <!-- parsing examples and help with part three of itp found here: https://code.tutsplus.com/tutorials/how-to-parse-json-in-php--cms-36994 -->

<?php
if (isset($_GET["ticket"])){
    $tic = $_GET["ticket"];
    $request = "https://idp.login.iu.edu/idp/profile/cas/serviceValidate?ticket=" . $tic . "&service=https://cgi.luddy.indiana.edu/~team36/loign.php";
    $file = file_get_contents($request);
   // echo $file;
    //var_dump($file);
    $dom = new DomDocument();
    $dom->loadXML($file);
    $xpath = new DomXPath($dom);
    $node = $xpath->query("//cas:user");
    // office hours thursday with makejari
    if ($node->length){
        $username=$node[0]->textContent;
        
        $_SESSION['username'] = $username;
        //echo $username;
        $emailend ='@iu.edu';
        //$user = substr($file,0,-50);
        //echo strrev($user);
        $IUemail =$username.$emailend;
        //echo $IUemail;
       // echo $IUemail;
       // echo $IUemail;
       $compare = "SELECT * FROM user WHERE email=" . "'" . $IUemail . "'";
       $query = mysqli_query($conn,$compare);
        if (mysqli_num_rows($query == 0)){
            echo "fill out login first";

        } else {
            $compare = "SELECT * FROM user WHERE email=" . "'" . $IUemail . "'";
            $query = mysqli_query($conn,$compare);
            if (mysqli_num_rows($query) == 0){
                $insert = "INSERT INTO user (Fname, Lname, email) VALUES ('$fname', '$lname', '$IUemail')";
                if ($conn->query($insert) === TRUE) {
                    echo "User added to database";
                } else {
                    echo "Error: " . $insert . "<br>" . $conn->error;
                }
            } else {
                echo "User already exists in database";
            }
        }

    }
  
}
//if ($IUemail)
//https://idp.login.iu.edu/idp/profile/cas/logout


// $authenticated = 'https://idp.login.iu.edu/idp/profile/cas/login?service=https://cgi.luddy.indiana.edu/~hstarnes/capstone-individual/home.php'
// if ($authenticated) {      
//     //validate since authenticated   
//     if (isset($_GET["ticket"])) {

//     }
//}
// 3:00 office hour help for flag stuff

//     $sql = "INSERT INTO user (fname, lname, email) VALUES ('$fname','$lname','$email')";

//     if (mysqli_query($con,$sql)) {
      
//         echo "1 record added";
      
//     } else { die(mysqli_error($con)); }
// }



function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

mysqli_close($conn);

?>


</body>
</html>