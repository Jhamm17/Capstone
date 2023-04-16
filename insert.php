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

    $fname = $_POST["Fname"];
    $lname = $_POST["Lname"];
    $email = $_POST["email"];
    $FavTeam = $_POST["FavTeam"];
    $FavSport = $_POST["FavSport"];
    $GradYear = $_POST["GradYear"];
    $bio = $_POST["bio"];
   
    //https://www.w3schools.com/php/php_form_url_email.asp
     $login_data = [
         'Fname' => $fname,
         'Lname' => $lname,
         'email' => $email,
         'FavTeam' => $FavTeam,
         'FavSport' => $FavSport,
         'GradYear' => $GradYear,
         'bio' => $bio,
     ];
   //  $duplicate = "SELECT * FROM user where (email = '$email')";
    // $dupe = mysqli_query($duplicate);
    //https://stackoverflow.com/questions/7719039/check-for-duplicates-before-inserting
         $sql = "INSERT INTO user (Fname, Lname, email, FavTeam, FavSport, GradYear, bio) VALUES ('$fname','$lname','$email','$FavTeam','$FavSport','$GradYear','$bio')";
         if (mysqli_query($conn,$sql)) {
      
            header("location: homepage.php");
          
         } else {
             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
         }
    
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