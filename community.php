<html>
    <head>
        <title>Community Home Page</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h1>Communities: </h1>
        <center><a href="createcommunity.php"><button class="comm">Create</button></a><a href="viewcommunities.php"><button class="comm">Your Communities</button></a></center>
        <center>
            <table class="tabledesign">
                <?php
                    $db = mysqli_connect("db.luddy.indiana.edu","i494f22_samanort","my+sql=i494f22_samanort","i494f22_samanort") or die("Error connecting to MySQL server.");
                    if (mysqli_connect_errno()){
                        echo 'failed to connect to SQL';
                    }
                    $query1 = "SELECT * FROM community";
                    mysqli_query($db, $query1) or die('Error querying database.');
                    $result = mysqli_query($db, $query1);
                    $row = mysqli_fetch_array($result);
                    echo '<tr><th>Community Name</th><th>Subject</th><th>Join?</th></tr>';
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>" . $row['comm_name'] . "</td>";
                        echo "<td>" . $row['comm_subject'] . "</td>";
                        echo "<td>Request to Join</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </center>
    </body>
</html>