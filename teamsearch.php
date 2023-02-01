<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h1><center>Intramural Team Search Page!</center></h1>
        <center><table class="tabledesign">
            <?php
                $db = mysqli_connect("db.luddy.indiana.edu","i494f22_samanort","my+sql=i494f22_samanort","i494f22_samanort") or die("Error connecting to MySQL server.");
                if (mysqli_connect_errno()){
                    echo 'failed to connect to SQL';
                }
                $query1 = "SELECT * FROM Teams";
                mysqli_query($db, $query1) or die('Error querying database.');
                $result = mysqli_query($db, $query1);
                $row = mysqli_fetch_array($result);
                echo '<tr><th>Item id</th><th>Team Name</th><th>Sport</th><th>League</th><th>Number of Players</th></tr>';
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row['Team_id'] . "</td>";
                    echo "<td>" . $row['team_name'] . "</td>";
                    echo "<td>" . $row['Sport'] . "</td>";
                    echo "<td>" . $row['League'] . "</td>";
                    echo "<td>" . $row['Num_players'] . "</td>";
                    echo "</tr>";
                }
                mysqli_close($db);
            ?>
        </table></center>
    </body>
</html>