<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    
<?php
session_start();
$user_id = $_SESSION['user_id'];
$email = trim($_SESSION['email']);
$con = mysqli_connect("db.luddy.indiana.edu","i494f22_team36","my+sql=i494f22_team36","i494f22_team36");

if ($con->connect_error) {
    die("connection failed: " . $con->connect_error);
}

$sql = "SELECT chat.msg, user.Fname, user.Lname FROM chat INNER JOIN user ON chat.id=user.userid";
$result = $con->query($sql);



if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        echo $row["Fname"] + $row["Lname"] . "<br>";
        echo $row["msg"]. "<br><br>";
    }
} else {
    echo "no messages have been exchanged yet";
}
$conn->close();
?>

</body>
</html>