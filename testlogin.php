</div>
    <br>
    <h3>Login</h3>
    <!-- parsing examples and help with part three of itp found here: https://code.tutsplus.com/tutorials/how-to-parse-json-in-php--cms-36994 -->

    <?php
// Start a PHP session
session_start();

// Check if the user is already authenticated
if (isset($_SESSION['username'])) {
    echo "You are already logged in as " . $_SESSION['username'];
} else {
    // If the user is not authenticated, check if a CAS ticket was received
    if (isset($_GET['ticket'])) {
        $ticket = $_GET['ticket'];
        $service_url = 'https://cgi.luddy.indiana.edu/~team36/loign.php';
        $cas_url = 'https://idp.login.iu.edu/idp/profile/cas/serviceValidate';
        
        // Validate the ticket with the CAS server
        $validate_url = $cas_url . '?ticket=' . $ticket . '&service=' . urlencode($service_url);
        $response = file_get_contents($validate_url);
        
        // Parse the response and extract the username
        $xml = simplexml_load_string($response);
        $namespaces = $xml->getDocNamespaces();
        $cas_ns = $xml->children($namespaces['cas']);
        $user = (string) $cas_ns->authenticationSuccess->user;
        
        // Store the username in the session
        $_SESSION['username'] = $user;

        // Connect to the database
        $host = 'localhost';
        $user = 'username';
        $password = 'password';
        $database = 'database_name';
        $conn = mysqli_connect($host, $user, $password, $database);

        // Retrieve the user data from the database
        $query = "SELECT * FROM user WHERE email='" . $user . "@iu.edu'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) == 0) {
            // If the user does not exist, display a form to collect their information
            echo '<form method="POST" action="insert.php">';
            echo 'First Name: <input type="text" name="Fname" required><br>';
            echo 'Last Name: <input type="text" name="Lname" required><br>';
            echo 'Email: <input type="text" name="email" value="' . $user . '@iu.edu" readonly><br>';
            echo '<button type="submit" name="login">Submit</button>';
            echo '</form>';
        } else {
            // If the user already exists, display a message
            echo "You are logged in as " . $user . ".";
            $row = mysqli_fetch_assoc($result);
            echo "<br>";
            echo "User Data: <br>";
            echo "ID: " . $row['id'] . "<br>";
            echo "First Name: " . $row['Fname'] . "<br>";
            echo "Last Name: " . $row['Lname'] . "<br>";
            echo "Email: " . $row['email'] . "<br>";
        }
        
    } else {
        // If the user is not authenticated and no CAS ticket was received, redirect them to the CAS login page
        $login_url = 'https://idp.login.iu.edu/idp/profile/cas/login?service=' . urlencode('https://cgi.luddy.indiana.edu/~team36/loign.php');
        header('Location: ' . $login_url);
    }
}
?>



</body>
</html>