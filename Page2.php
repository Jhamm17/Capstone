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
$input = $_POST['msg'];
$con = mysqli_connect("db.luddy.indiana.edu","i494f22_team36","my+sql=i494f22_team36","i494f22_team36");
if ($con->connect_error) {
    die("connection failed: " . $con->connect_error);
}

$sql = "INSERT INTO chat (msg) VALUES ('$input')";

if ($con->query($sql) === TRUE) {
    header("location: chat.php");
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
$con->close();
?>

</body>
</html>