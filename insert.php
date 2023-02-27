<?php
session_start(),
$servername = "db.luddy.indiana.edu";
$username = "i494f22_team36";
$password = "my+sql=i494f22_team36";
$dbname = "i494f22_team36";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

if(isset($_POST['login'] )){
   // $fname = test_input($_POST["Fname"]);
   // if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
    //  $fnameErr = "Only letters and white space allowed";
    //  echo $fnameErr;
    //  $flag = 0;
   // }    h
   // echo '<br>';
  //  $lname = test_input($_POST["Lname"]);
   // if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
     // $lnameErr = "Only letters and white space allowed";
     // echo $lnameErr;
    //  $flag = 0;
   // }
   // echo '<br>';
    $flag = 1;

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
   //  $duplicate = "SELECT * FROM user where (email = '$email')";
    // $dupe = mysqli_query($duplicate);
    //https://stackoverflow.com/questions/7719039/check-for-duplicates-before-inserting
         $sql = "INSERT INTO user (Fname, Lname, email) VALUES ('$fname','$lname','$email')";
         if (mysqli_query($conn,$sql)) {
      
             echo "1 record added";
          
         } else {
             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
         }
    
}   

if
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