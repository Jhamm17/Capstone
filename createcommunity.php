<html>
    <head>
        <title>Community Create Page</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h1>Create a Community!<h1>
        <form name="commcreate" method="POST" action="">
            <label for="commname">Community Name</label>
            <input type="text" name="commname"></input><br>
            <label for="commsub">Subject</label>
            <input type="text" name="commsub"></input><br>
            <label for="commbio">Bio</label>
            <input type="text" name="commbio"></input>
            <label for="commprivacy">Privacy</label>
            <select name="commprivacy" id="commprivacy">
                <option value="private">Private</option>
                <option value="public">Public</option><br>
            <input type="submit" value="submit" id="submit">
        </form>
    </body>
</html>