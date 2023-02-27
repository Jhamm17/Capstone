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
session_start();

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

mysqli_close($conn);

?>


</body>
</html>