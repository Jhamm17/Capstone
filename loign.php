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
        First Name: <input type="text" name="fname" required><br>
        Last Name: <input type="text" name="lname" required><br>
        email: <input type="text" name="email" required><br>

        <button type="submit" name="login">submit</button>
    </form>

<?php
if(isset($_POST['login'] )){
    $flag = 1;
    $fname = test_input($_POST["fname"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
      $fnameErr = "Only letters and white space allowed";
      echo $fnameErr;
      $flag = 0;
    }    
    echo '<br>';
    $lname = test_input($_POST["lname"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
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
    //https://www.w3schools.com/php/php_form_url_email.asp
    $login_data = [
        'fname' => $fname,
        'lname' => $lname,
        'email' => $email,
    ];
    $duplicate = "SELECT * FROM user where (email = '$email')";
    $dupe = mysql_query($duplicate);
    //https://stackoverflow.com/questions/7719039/check-for-duplicates-before-inserting
    if ($flag == 1 AND mysql_num_rows($dupe) > 0){
        $sql = "INSERT INTO user (Fname, Lname, email) VALUES ('$fname','$lname','$email')";
        if (mysqli_query($con,$sql)) {
      
            echo "1 record added";
          
        } else { die(mysqli_error($con)); }
    }
}   

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
       $query = mysqli_query($con,$compare);
        if (mysqli_num_rows($query == 0)){
            echo "fill out login first";

        }else{
            echo "logged in";
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

mysqli_close($con);
?>

</body>

</html>