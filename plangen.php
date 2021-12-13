<!DOCTYPE html>
<html>

    <head>
        <title>
            Plan Generator
        </title>
        <link rel="stylesheet" href="plangen.css" type="text/css" />
    </head>

    <body>

        <form action="plangen.php" method="post">
            <br/> <br/> <div id="large"> <u> <b> Let's Calculate How Many Hours You Need to Exercise </b> </u> </div> <br/> <br/>
            <u> Enter Final Date:</u> <input type="date" name="date" maxlength="5" size="3" /> <br/> <br/>
            <u> Enter Daily Caloric Intake:</u> <input name="calories" maxlength="5" size="3" /> calories <br/> <br/>
            <u> Enter Weight Goal:</u> <input name="goal" maxlength="5" size="3" /> pounds <br/> <br/>
            <u> Enter Exercise Intensity:</u> <select name="intensity" /> <option> Low Intensity </option> <option> Medium Intensity </option> <option> High Intensity </option> </select> <br/> <br/>
            <input type="submit" name="add" value="Submit" />
        </form>

        <?php
            if (isset($_POST["add"])) {
                
                $date = $_POST["date"];
                $calories = $_POST["calories"];
                $goal = $_POST["goal"];
                $intensity = $_POST["intensity"];
                $hasPlan = FALSE;
                
                session_start();
                $weight = $_SESSION["weight"];

                if (!$date) { print ("Final date not selected.<br>"); }
                
                if ($calories > 999 && $calories < 3001) { $caloriesVerify = true; }
                else { print ("Calories per day must be between 1000 and 3000.<br>"); }
                
                if ($goal > 79 && $goal < 301 && $goal < $weight) { $goalVerify = true; }
                else { print ("Goal weight must be between 80 and 300 pounds and less than your current weight.<br>"); }
                
                if (!$intensity) { print ("Exercise intensity not selected.<br>"); }


                if ($date && $caloriesVerify && $goalVerify && $intensity) {
                    
                    $_SESSION["date"] = $date;
                    $_SESSION["calories"] = $calories;
                    $_SESSION["goal"] = $goal;
                    $_SESSION["intensity"] = $intensity;
                    $_SESSION["hasplan"] = $hasPlan;
                    
                    header("Location: results.php");
                }
 
            } ?>

    </body>
</html>