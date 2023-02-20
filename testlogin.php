<?php
session_start();

if (isset($_GET["ticket"])){
    $tic = $_GET["ticket"];
    $request = "https://idp.login.iu.edu/idp/profile/cas/serviceValidate?ticket=" . $tic . "&service=https://cgi.luddy.indiana.edu/~team36/login.php";
    $file = file_get_contents($request);
    $dom = new DomDocument();
    $dom->loadXML($file);
    $xpath = new DomXPath($dom);
    $node = $xpath->query("//cas:user");
    
    if ($node->length){
        $username = $node[0]->textContent;
        $_SESSION['username'] = $username;
        
        $emailend = '@iu.edu';
        $IUemail = $username . $emailend;
        
        // Connect to the database
        $servername = "db.luddy.indiana.edu";
        $username = "i494f22_team36";
        $password = "my+sql=i494f22_team36";
        $dbname = "i494f22_team36";
        $conn = mysqli_connect($host, $user, $password, $database);
        
        // Check if the user exists in the database
        $compare = "SELECT * FROM user WHERE email='" . $IUemail . "'";
        $query = mysqli_query($conn, $compare);
        
        if (mysqli_num_rows($query) == 0){
            // If the user does not exist, display the form to collect their information
            echo '
            <form action="inserttest.php" method="POST">
                First Name: <input type="text" name="Fname" required><br>
                Last Name: <input type="text" name="Lname" required><br>
                email: <input type="text" name="email" value="' . $IUemail . '" readonly><br>
                <button type="submit" name="login">submit</button>
            </form>';
        } else {
            // If the user already exists, show a message
            echo "You are logged in as " . $username;
        }
    }
}
?>
