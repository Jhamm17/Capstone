<?php
// Connect to the database
$servername = "db.luddy.indiana.edu";
$username = "i494f22_team36";
$password = "my+sql=i494f22_team36";
$dbname = "i494f22_team36";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if (isset($_POST['login']) && isset($_POST['Fname']) && isset($_POST['Lname']) && isset($_POST['email'])) {
    // Retrieve the form data
    $fname = $_POST['Fname'];
    $lname = $_POST['Lname'];
    $email = $_POST['email'];

    // Insert the data into the database
    $query = "INSERT INTO user (Fname, Lname, email) VALUES ('" . $fname . "', '" . $lname . "', '" . $email . "')";
    $result = mysqli_query($conn, $query);

    // Check if the data was inserted successfully
    if ($result) {
        echo "User data was inserted successfully.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
