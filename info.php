<!DOCTYPE html>
<html>

    <head>
        <title>
            Enter Info
        </title>
        <link rel="stylesheet" href="info.css" type="text/css" />
    </head>

    <body>

        <form action="info.php" method="post">
            <br/> <br/> <div id="large"> <u> <b> Enter Your Information </b> </u> </div> <br/> <br/>
            <u> Enter Gender:</u> <select name="gender" /> <option> Male </option> <option> Female </option> </select> <br/> <br/>
            <u> Enter Age:</u> <input name="age" maxlength="5" size="3" /> years <br/> <br/>
            <u> Enter Height:</u> <input name="feet" maxlength="5" size="3" /> feet <input name="inches" maxlength="5" size="3" /> inches <br/> <br/>
            <u> Enter Current Weight:</u> <input name="weight" maxlength="5" size="3" /> pounds <br/> <br/>
            Do you have a workout plan, or would you like one created for you? <br/> <br/>
            <input type="submit" name="add1" value="Have a Plan" />
            <input type="submit" name="add2" value="Generate Plan" />
        </form>

        <?php

            if (isset($_POST["add1"]) || isset($_POST["add2"])) {
                $gender = $_POST["gender"];
                $age = $_POST["age"];
                $feet = $_POST["feet"];
                $inches = $_POST["inches"];
                $height = ($feet * 12) + $inches;
                $weight = $_POST["weight"];


                if (!$gender) { print ("Gender not selected.<br>"); }
                
                if ($age > 14 && $age < 76) { $ageVerify = true; }
                else { print ("Age must be between 15 and 75 years.<br>"); }
                
                if ($height > 49 && $height < 81) { $heightVerify = true; }
                else { print ("Height must be between 4'2\" and 6'8\".<br>"); }
                                
                if ($weight > 99 && $weight < 401) { $weightVerify = true; }
                else { print ("Weight must be between 100 and 400 pounds.<br>"); }


                if ($gender && $ageVerify && $heightVerify && $weightVerify) {
                    
                    session_start();
                    $_SESSION["gender"] = $gender;
                    $_SESSION["age"] = $age;
                    $_SESSION["height"] = $height; 
                    $_SESSION["weight"] = $weight;
                    
                    if (isset($_POST["add1"]))
                        header("Location: hasplan.php");
                    if (isset($_POST["add2"]))
                        header("Location: plangen.php");
                }
            } ?>

    </body>
</html>