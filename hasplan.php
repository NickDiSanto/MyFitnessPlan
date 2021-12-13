<!DOCTYPE html>
<html>

    <head>
        <title>
            Have a Plan
        </title>
        <link rel="stylesheet" href="hasplan.css" type="text/css" />
    </head>

    <body>

        <form action="hasplan.php" method="post">
            <br/> <br/> <div id="large"> <u> <b> Let's Calculate When You Will Reach Your Goal </b> </u> </div> <br/> <br/>
            <u> Enter Hours of Cardio/Week:</u> <input name="hours" maxlength="5" size="3" /> hours <br/> <br/>
            <u> Enter Daily Caloric Intake:</u> <input name="calories" maxlength="5" size="3" /> calories <br/> <br/>
            <u> Enter Weight Goal:</u> <input name="goal" maxlength="5" size="3" /> pounds <br/> <br/>
            <u> Enter Exercise Intensity:</u> <select name="intensity" /> <option> Low Intensity </option> <option> Medium Intensity </option> <option> High Intensity </option> </select> <br/> <br/>
            <input type="submit" name="add" value="Submit" />
        </form>

        <?php
            if (isset($_POST["add"])) {
                
                $hours = $_POST["hours"];
                $calories = $_POST["calories"];
                $goal = $_POST["goal"];
                $intensity = $_POST["intensity"];
                $hasPlan = TRUE;
                
                session_start();
                $weight = $_SESSION["weight"];

                if ($hours > 0 && $hours < 31) { $hoursVerify = true; }
                else { print ("Hours of cardio per week must be between 1 and 30.<br>"); }
                
                if ($calories > 999 && $calories < 3001) { $caloriesVerify = true; }
                else { print ("Calories per day must be between 1000 and 3000.<br>"); }
                
                if ($goal > 79 && $goal < 301 && $goal < $weight) { $goalVerify = true; }
                else { print ("Goal weight must be between 80 and 300 pounds and less than your current weight.<br>"); }
                
                if (!$intensity) { print ("Exercise intensity not selected.<br>"); }


                if ($hoursVerify && $caloriesVerify && $goalVerify && $intensity) {
                    
                    $_SESSION["hours"] = $hours;
                    $_SESSION["calories"] = $calories;
                    $_SESSION["goal"] = $goal;
                    $_SESSION["intensity"] = $intensity;
                    $_SESSION["hasplan"] = $hasPlan;
                    
                    header("Location: results.php");
                }
 
            } ?>

    </body>
</html>