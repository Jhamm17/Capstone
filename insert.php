<?php
$servername = "db.luddy.indiana.edu";
$username = "i494f22_team36";
$password = "my+sql=i494f22_team36";
$dbname = "i494f22_team36";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

if(isset($_POST['login'] )){
    $flag = 1;
   // $fname = test_input($_POST["Fname"]);
   // if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
    //  $fnameErr = "Only letters and white space allowed";
    //  echo $fnameErr;
    //  $flag = 0;
   // }    
   // echo '<br>';
  //  $lname = test_input($_POST["Lname"]);
   // if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
     // $lnameErr = "Only letters and white space allowed";
     // echo $lnameErr;
    //  $flag = 0;
   // }
   // echo '<br>';

    $fname = $_POST["Fname"];
    $lname = $_POST["Lname"];
    $email = $_POST["email"];
   // $email = filter_var($email, FILTER_SANITIZE_EMAIL);


   // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //  $emailErr = "Invalid email format";
    //  echo $emailErr;
    //  $flag = 0;

 
    //}
    //https://www.w3schools.com/php/php_form_url_email.asp
    $login_data = [
        'Fname' => $fname,
        'Lname' => $lname,
        'email' => $email,
    ];
    $duplicate = "SELECT * FROM user where (email = '$email')";
    $dupe = mysql_query($duplicate);
    //https://stackoverflow.com/questions/7719039/check-for-duplicates-before-inserting
    if ($flag == 1 AND mysql_num_rows($dupe) > 0){
        $sql = "INSERT INTO user (Fname, Lname, email) VALUES ('$fname','$lname','$email')";
        if (mysqli_query($conn,$sql)) {
      
            echo "1 record added";
          
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
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

//code above from W3 schools https://www.w3schools.com/php/php_form_url_email.asp

// $discount_decoded = json_decode($discount, true);

//  $username = $discount_decoded['username'];
//  $percent = $discount_decoded['discount'];

 //if($percent == 0) {
 //   echo ' There is no current discount ';
//} else {
 //   echo 'Your discount is '. $percent;
//}
//was breaking my code before so i just commented it out
?>