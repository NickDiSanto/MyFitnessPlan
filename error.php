<html>

    <head>
        <title>
            ERROR
        </title>
        <link rel="stylesheet" href="error.css" type="text/css" />
    </head>

    <body>
        
        <form action="error.php" method="post">
            <div>
                <?php
                    session_start();
                    $calories = $_SESSION["calories"];
                    $hours = $_SESSION["hours"];
                    $calsBurnedPerDay = $_SESSION["calsBurnedPerDay"];
                    $hoursRecommended = $_SESSION["hoursRecommended"];
                ?>

                <br/> <br/> Uh-oh! Unfortunately, the information you provided will not lead to any weight loss. <br/> <br/>
                In order to lose weight, <b> you must burn more calories than you consume. </b> <br/> <br/> <br/>
                In your case, you are eating <b> <?php print $calories; ?> </b> calories per day, while you are burning <b> <?php print round($calsBurnedPerDay, 1, PHP_ROUND_HALF_UP); ?> </b> calories per day. <br/>
                In order to lose weight while eating <b> <?php print $calories; ?> </b> calories per day at this intensity, you must exercise at least <b> <?php print round($hoursRecommended, 1, PHP_ROUND_HALF_UP); ?> </b> hours per week. <br/>
                Alternatively, if you continue to exercise <b> <?php print $hours; ?> </b> hours per week at this intensity, you must eat less than <b> <?php print round($calsBurnedPerDay, 1, PHP_ROUND_HALF_UP); ?> </b> calories per day to lose weight. <br/> <br/> <br/>
                <b> Please re-examine your information and click the link below to try again. </b> Thanks! <br/>
                <?php
                    session_destroy();
                ?>
                <input type="submit" name="add" value="Try Again" />
            <div>
        </form>
        
        <?php
            if (isset($_POST["add"]))
                header("Location: info.php");
        ?>
        
    </body>
</html>