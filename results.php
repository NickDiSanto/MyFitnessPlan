<!DOCTYPE html>
<html>

    <head>
        <title>
            Results
        </title>
        <link rel="stylesheet" href="results.css" type="text/css" />
    </head>

    <body>

        <form action="results.php" method="post">
            <?php
                session_start();
                $gender = $_SESSION["gender"];
                $age = $_SESSION["age"];
                $height = $_SESSION["height"];
                $weight = $_SESSION["weight"];
                $hours = $_SESSION["hours"];
                $date = $_SESSION["date"];
                $calories = $_SESSION["calories"];
                $goal = $_SESSION["goal"];
                $intensity = $_SESSION["intensity"];
                $hasPlan = $_SESSION["hasplan"];
                $calsPerPound = 3500;
                
                if ($gender == "Male") {
                    $bmr = (66 + (6.2*$weight) + (12.7*$height) - (6.76*$age));
                    
                    if ($intensity == "Low Intensity")
                        $calsBurnedPerHour = 350;
                    if ($intensity == "Medium Intensity")
                        $calsBurnedPerHour = 600;
                    if ($intensity == "High Intensity")
                        $calsBurnedPerHour = 850;
                }
                if ($gender == "Female") {
                    $bmr = (655.1 + (4.35*$weight) + (4.7*$height) - (4.7*$age));
                    
                    if ($intensity == "Low Intensity")
                        $calsBurnedPerHour = 250;
                    if ($intensity == "Medium Intensity")
                        $calsBurnedPerHour = 500;
                    if ($intensity == "High Intensity")
                        $calsBurnedPerHour = 750;
                }
                
                if (!$hasPlan) {
                    $days = (strtotime($date) - strtotime("2021-04-16"))/60/60/24;
                    $hours = 7 * ((($calories - $bmr) * $days) + ($calsPerPound * ($weight - $goal))) / ($calsBurnedPerHour * $days);
                }
                
                if ($hasPlan) {
                    $days = 7 * ($calsPerPound * ($weight - $goal)) / ($calsBurnedPerHour * $hours);
                    $calsBurnedPerDay = $bmr + ($calsBurnedPerHour * $hours / 7);

                    if ($calsBurnedPerDay < $calories) {
                        $_SESSION["calsBurnedPerDay"] = $calsBurnedPerDay;
                        $hoursRecommended = 7 * ($calories - $bmr) / $calsBurnedPerHour;
                        $_SESSION["hoursRecommended"] = $hoursRecommended;
                        header("Location: error.php");
                    }
                }
                
                $bmi = round($weight * 703 / ($height * $height), 1, PHP_ROUND_HALF_DOWN);
                $bmigoal = round($goal * 703 / ($height * $height), 1, PHP_ROUND_HALF_DOWN);
            ?>
            
            <br/> <br/> <div id="large"> <u> <b> Final Results </b> </u> </div> <br/> <br/>
            <u> Current Weight:</u> <b> <?php print $weight; ?> </b> <br/> <br/>
            <u> Current BMI (Body Mass Index):</u> <b> <?php print $bmi; ?> </b> <br/> <br/>
            This BMI classifies you as <b>
            <?php
                if ($bmi < 15)
                    print '<span style="color:#6B009A">"Very Severely Underweight"</span>';
                if ($bmi >= 15 && $bmi < 16)
                    print '<span style="color:#E7B3FF">"Severely Underweight"</span>';
                if ($bmi >= 16 && $bmi < 18.5)
                    print '<span style="color:#9AE7FF">"Underweight"</span>';
                if ($bmi >= 18.5 && $bmi < 25)
                    print '<span style="color:#5BD75B">"Normal (Healthy) Weight"</span>';
                if ($bmi >= 25 && $bmi < 30)
                    print '<span style="color:#FFFF4D">"Overweight"</span>';
                if ($bmi >= 30 && $bmi < 35)
                    print '<span style="color:#FF684D">"Moderately Obese"</span>';
                if ($bmi >= 35 && $bmi < 40)
                    print '<span style="color:#FF43A9">"Severely Obese"</span>';
                if ($bmi >= 40)
                    print '<span style="color:#EB2D53">"Very Severely Obese"</span>';
            ?> </b> <br/> <br/> <br/> <br/>
            <u> Goal Weight:</u> <b> <?php print $goal; ?> </b> <br/> <br/>
            <u> Goal BMI (Body Mass Index):</u> <b> <?php print $bmigoal; ?> </b> <br/> <br/>
            Your goal BMI would classify you as <b>
            <?php
                if ($bmigoal < 15)
                    print '<span style="color:#6B009A">"Very Severely Underweight"</span>';
                if ($bmigoal >= 15 && $bmigoal < 16)
                    print '<span style="color:#E7B3FF">"Severely Underweight"</span>';
                if ($bmigoal >= 16 && $bmigoal < 18.5)
                    print '<span style="color:#9AE7FF">"Underweight"</span>';
                if ($bmigoal >= 18.5 && $bmigoal < 25)
                    print '<span style="color:#5BD75B">"Normal (Healthy) Weight"</span>';
                if ($bmigoal >= 25 && $bmigoal < 30)
                    print '<span style="color:#FFFF4D">"Overweight"</span>';
                if ($bmigoal >= 30 && $bmigoal < 35)
                    print '<span style="color:#FF684D">"Moderately Obese"</span>';
                if ($bmigoal >= 35 && $bmigoal < 40)
                    print '<span style="color:#FF43A9">"Severely Obese"</span>';
                if ($bmigoal >= 40)
                    print '<span style="color:#EB2D53">"Very Severely Obese"</span>';
            ?> </b> <br/> <br/> <br/>
            <?php
                if ($hours < 0)
                    $hours = 0;
            ?>
            At <b> <?php print round($hours, 1, PHP_ROUND_HALF_UP) ?> </b> hours of cardio per week, you will reach your goal in <b> <?php print round($days); ?> </b> days. <br/> <br/> <br/> <br/>
            
            <b> Click the button below to log out. </b> <br/> <br/>
            <input type="submit" name="add" value="Log Out" /> <br/> <br/>
        </form>
        
        <?php
            if (isset($_POST["add"])) {
                session_destroy();
                header("Location: index.php");
            }
        ?>
    </body>
</html>