<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h1><center>Intramural Player Search Page!</center></h1>
        <center><table class="tabledesign">
            <?php
                $db = mysqli_connect("db.luddy.indiana.edu","i494f22_samanort","my+sql=i494f22_samanort","i494f22_samanort") or die("Error connecting to MySQL server.");
                if (mysqli_connect_errno()){
                    echo 'failed to connect to SQL';
                }
                $query1 = "SELECT * FROM Intramurals";
                mysqli_query($db, $query1) or die('Error querying database.');
                $result = mysqli_query($db, $query1);
                $row = mysqli_fetch_array($result);
                echo '<tr><th>Preferred Sport</th><th>On Team?</th><th>User Email</th><th>Player ID</th></tr>';
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row['Preferred_sport'] . "</td>";
                    echo "<td>" . $row['On_team'] . "</td>";
                    echo "<td>" . $row['user_email'] . "</td>";
                    echo "<td>" . $row['player_id'] . "</td>";
                    echo "</tr>";
                }
                mysqli_close($db);
            ?>
        </table></center>
    </body>
</html>