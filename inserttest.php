<?php
// Connect to the database
$host = 'localhost';
$user = 'username';
$password = 'password';
$database = 'database_name';
$conn = mysqli_connect($host, $user, $password, $database);

// Check if the form was submitted
if (isset($_POST['login'])) {
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
