<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
<div class="topnav"> 
        <a href="homepage.php"><img class="homeImg" src="Images/smallLogo.png" alt="Home"></a>
        <a href="calendar.php">Calendar</a>
        <a href="chat.php">Chat</a> 
        <a href="community.php">Community</a> 
        <a href="intramurals.php">Intramural Sports</a> 
        <a href="live.php">IU Live</a>   
        <a href="polls.php">Polls</a>
        <a href="profile2.php">Profile</a>
        <a href="https://idp.login.iu.edu/idp/profile/cas/logout">Log-Out </a>

</div>
    <br>
    <h3>Sign-Up</h3>

    <form action="insert.php" method="POST">
       <center First Name: <input type="text" name="Fname" required><br> <center>
       <center> Last Name: <input type="text" name="Lname" required><br> <center>
       <center> email: <input type="text" name="email" required><br> <center>
       <center> Favorite Team:<input type="text" name="FavTeam" required><br> <center>
      <center>  Favorite Sport:<input type="text" name="FavSport" required><br> <center>
       <center> Graduation Year (Please Enter #):<input type="text" name="GradYear" required><br> <center>
       <center> Biography:<input type="text" name="bio" required><br> <center>
       <center> <button type="submit" name="login">Submit</button> <center>
    </form>

    <style>
        button[type=submit] {
            padding:5px 15px; 
            border:0 none;
            cursor:pointer;
            -webkit-border-radius: 5px;
            border-radius: 5px; 
        }

        input[type=text] {
            padding:5px; 
            border:2px solid #ccc; 
            -webkit-border-radius: 5px;
            border-radius: 5px;
        }
    </style>
    <!-- parsing examples and help with part three of itp found here: https://code.tutsplus.com/tutorials/how-to-parse-json-in-php--cms-36994 -->

<?php
session_start();

$servername = "db.luddy.indiana.edu";
$username = "i494f22_team36";
$password = "my+sql=i494f22_team36";
$dbname = "i494f22_team36";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// function cas_authenticate(){
//     $sid = SID; //SESSION ID
  
//     //Because SESSIONS are used, I default set it to false to make them login. 
//     //Watch out with this. I used it because I just wanted to authenticate that they are a student
//     //But if you plan to use CAS for the login method, this is a bad idea most likley.
//     //$_SESSION['CAS'] = false;
  
//     $authenticated = $_SESSION['CAS'];
//     //Make sure that your code redirects back to here or else you will get an error.
//     $casurl = "cgi.luddy.indiana.edu/~team36/loign.php";
  
//     //send user to CAS login if not authenticated
//     if (!$authenticated) {
//       $_SESSION['LAST_SESSION'] = time(); // update last activity time stamp
//       $_SESSION['CAS'] = true;
//       echo '<META HTTP-EQUIV="Refresh" Content="0; URL=https://cas.iu.edu/cas/login?cassvc=IU&casurl='.$casurl.'">';
  
//       exit;
//     }
  
//     if ($authenticated) {
//       if (isset($_GET["ticket"])) {
//         //set up validation URL to ask CAS if ticket is good
//         $_url = 'https://cas.iu.edu/cas/validate';
//         $cassvc = 'IU';
  
//         $params = "cassvc=$cassvc&casticket=$_GET[ticket]&casurl=$casurl";
//         $urlNew = "$_url?$params";
  
//         //CAS sending response on 2 lines. First line contains "yes" or "no". If "yes", second line contains username (otherwise, it is empty).
//         $ch = curl_init();
//         $timeout = 5; // set to zero for no timeout
//         curl_setopt ($ch, CURLOPT_URL, $urlNew);
//         curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
//         ob_start();
//         curl_exec($ch);
//         curl_close($ch);
//         $cas_answer = ob_get_contents();
//         ob_end_clean();
  
//         //split CAS answer into access and user
//         list($access,$user) = split("\n",$cas_answer,2);
//         $access = trim($access);
//         $user = trim($user);
  
//         //set user and session variable if CAS says YES
//         if ($access == "yes") {
//           $_SESSION['user'] = $user;
//         }
  
//       } else if (!isset($_SESSION['user'])) { //END GET CAS TICKET
//         echo '<META HTTP-EQUIV="Refresh" Content="0; URL=https://cas.iu.edu/cas/login?cassvc=IU&casurl='.$casurl.'">';
//       }
//     }
//   }//END CAS FUNCTION
  
//   cas_authenticate();
  
//   //gets the username from the SESSION and assigns it to username.
//   $username = $_SESSION['user'];
//   $email_address = $_SESSION['email_address'];

$_SESSION['CAS'] = false;
if(!isset($_SESSION['CAS'])){
    header('Location: calender.php');
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
         $username=trim($node[0]->textContent);
        
         $_SESSION["username"] = $username;
         //echo $username;
         $emailend =trim('@iu.edu');
         //$user = substr($file,0,-50);
         //echo strrev($user);
         $IUemail =$username.$emailend;
         $_SESSION["email"] = trim($IUemail);
         //echo $IUemail;
        // echo $IUemail;
        // echo $IUemail;
        $email = trim($_SESSION['email']);

        $compare = "SELECT * FROM user WHERE email=" . "'" . $email . "'";
        $query = mysqli_query($conn,$compare);
         if (mysqli_num_rows($query) == 0){
             echo "fill out login first";

         }else{
            //  $userid = "SELECT userid FROM user WHERE email=" . "'" . $email . "'";
            //  $qu = mysqli_query($conn,$userid);
            header("Location: homepage.php");

            //  $_SESSION['userid'] = $qu;
            //  echo $_SESSION['userid'];
             //header('Location: profile2.php');
        

             //echo $IUemail;
         }
         if (mysqli_num_rows($query) == 1) {
            $row = mysqli_fetch_assoc($query);
            $_SESSION['user_id'] = $row['userid'];
        }
         $_SESSION['authenticated']=true;

         //if (isset($_SESSION['userid'])){
         //   header("Location: calender.php");
       // };
        

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