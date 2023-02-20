<?php
// User's login information
$username = $_POST['username'];
$password = $_POST['password'];

// API endpoint
$url = "https://idp.login.iu.edu/idp/profile/cas/login?service=https://cgi.luddy.indiana.edu/~team36/loign.php";

// Data to be sent with the request
$data = array(
    'username' => $username,
    'password' => $password
);

// Create a new cURL resource
$ch = curl_init();

// Set the URL and other options for the request
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Send the request and get the response
$response = curl_exec($ch);

// Check for errors
if(curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
}

// Close the cURL resource
curl_close($ch);

// Handle the response from the API
// For example, if the response is in JSON format
$user_data = json_decode($response, true);

// Connect to the database and insert the user information
// (See previous code example)

// Retrieve user information from the API
// For example, if the user information is in JSON format
$user_data = json_decode($api_response, true);

// Connect to the MySQL database
$servername = "db.luddy.indiana.edu";
$username = "i494f22_team36";
$password = "my+sql=i494f22_team36";
$dbname = "i494f22_team36";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create an SQL INSERT statement
$first_name = mysqli_real_escape_string($conn, $user_data['first_name']);
$last_name = mysqli_real_escape_string($conn, $user_data['last_name']);
$email = mysqli_real_escape_string($conn, $user_data['email']);

$sql = "INSERT INTO user_table (first_name, last_name, email) VALUES ('$first_name', '$last_name', '$email')";

// Execute the SQL INSERT statement
if (mysqli_query($conn, $sql)) {
    echo "User information inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
