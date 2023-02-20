<!-- Login form -->
<h3>Login</h3>
<form action="login.php" method="POST">
    Email: <input type="text" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit" name="login">Login</button>
</form>

<?php
if (isset($_POST["login"])) {
    // Get the user's email and password
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Authenticate the user using the external API
    $tic = ...; // get the ticket from the API
    $request = "https://idp.login.iu.edu/idp/profile/cas/serviceValidate?ticket=" . $tic . "&service=https://cgi.luddy.indiana.edu/~team36/loign.php";
    $file = file_get_contents($request);
    $dom = new DomDocument();
    $dom->loadXML($file);
    $xpath = new DomXPath($dom);
    $node = $xpath->query("//cas:user");
    if ($node->length) {
        $username = $node[0]->textContent;
        $emailend = '@iu.edu';
        $iu_email = $username . $emailend;
        
        // Check if the user's email already exists in your database
        $compare = "SELECT * FROM user WHERE email='" . $iu_email . "'";
        $query = mysqli_query($conn, $compare);
        if (mysqli_num_rows($query) == 0) {
            // If the user's email doesn't exist, insert their information into your database
            $insert = "INSERT INTO user (email, password) VALUES ('$iu_email', '$password')";
            if ($conn->query($insert) === TRUE) {
                echo "User added to database";
            } else {
                echo "Error: " . $insert . "<br>" . $conn->error;
            }
        } else {
            echo "User already exists in database";
        }
    }
}
