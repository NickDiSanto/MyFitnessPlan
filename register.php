<!DOCTYPE html>
<html>

    <head>
        <title>
            Register
        </title>
        <link rel="stylesheet" href="register.css" type="text/css" />
    </head>

    <body>

        <form action="register.php" method="post">
            <br/> <br/> <div id="large"> <u> <b> Create a New Account </b> </u> </div> <br/> <br/>
            <u> Create Username:</u> <input name="username" minlength="5" maxlength="15" size="15" /> <br/> <br/>
            <u> Create Password:</u> <input type="password" name="password" minlength="5" maxlength="15" size="15" /> <br/> <br/>
            <input type="submit" name="add" value="Submit" />
        </form>

        <?php
            if (isset($_POST["add"])) {
                
                $username = $_POST["username"];
                $password = $_POST["password"];

                $usernameVerify = strlen($username) > 4 && strlen($username) < 21;
                $passwordVerify = strlen($password) > 4 && strlen($password) < 21;
          
                if (!$usernameVerify)
                    print ("Username must be between 5 and 20 characters.<br>");
                if (!$passwordVerify)
                    print ("Password must be between 5 and 20 characters.<br>");
                if ($usernameVerify && $passwordVerify) {
                    
                    $servername = getenv('IP');
                    $user = "root";
                    $pass = "Ballgame1000!";
                    $database = "egr223";
                    $dbport = 3306;
                    $db = new mysqli($servername, $user, $pass, $database, $dbport);
                    $sql = "INSERT INTO users VALUES (null, '$username', '$password')";
                    $result = mysqli_query($db, $sql);

                    if (!$result)
                        print "Username already taken. Please try again.";
                    else
                        header("Location: index.php");
                }
            } ?>

    </body>
</html>