<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h1><center>Intramural Create Team Page!</center></h1>
        <center><form name="teamcreate" method="POST" action="">
            <label for="teamname">Team Name: </label>
            <input type="text" name="teamname"></input><br><br>
            <label for="sport">Sport: </label>
            <input type="text" name="sport"></input><br><br>
            <label for="numplayers">Player amount: </label>
            <input type="number" name="numplayers"></input><br><br>
            <label for="league">League: </label>
            <select name="league" id="league"><br>
                <option value="Competitive">Competitive</option>
                <option value="Casual">Casual</option>
                <option value="Rec">Rec</option><br><br>
            <br><input type="submit" name="submit" value="submit">
        </form></center>
    </body>
</html>