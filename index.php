<!DOCTYPE html>
<html>

    <head>
        <title>
            Login
        </title>
        <link rel="stylesheet" href="index.css" type="text/css" />
    </head>

    <body>

        <form action="index.php" method="post">
            <br/> <br/> <div id="large"> <u> <b> Welcome to MyFitnessPlan! </b> </u> </div> <br/> <br/>
            <u> Enter Username:</u> <input name="username" minlength="5" maxlength="15" size="15" /> <br/> <br/>
            <u> Enter Password:</u> <input type="password" name="password" minlength="5" maxlength="15" size="15" /> <br/> <br/>
            <input type="submit" name="add" value="Submit" />
            <a href="register.php"> Create New Account </a>
        </form>

        <?php
            if (isset($_POST["add"])) {
                
                $servername = getenv('IP');
                $user = "root";
                $pass = "Ballgame1000!";
                $database = "egr223";
                $dbport = 3306;
                $db = new mysqli($servername, $user, $pass, $database, $dbport);
                
                $query = "select * from users where username = '" . $_POST['username'] . "' and password = '" . $_POST['password'] ."' ";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                if (!$row)
                    print "Login invalid. Please try again.";
                else
                    header("Location: info.php");
            } ?>

    </body>
</html>