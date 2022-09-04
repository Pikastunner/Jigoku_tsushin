<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="Project_1.css">
        <link rel="icon" type="image/x-icon" href="hell_girl.ico">
        <title>I consign this grievance to hell</title>
<body style="background-color:black;">
<?php 
    $name = $_GET["person"];
    echo "<link rel = 'stylesheet' href = 'names.css'/>";
    if (empty($name)) {
        echo '<div style="color: white">There is no one being sent to hell'."</div>";
    }
    elseif (str_contains(file_get_contents("data.txt"), $name)) {
        $all = file_get_contents("data.txt");
        $fp = fopen('arg.txt', 'w');
        fwrite($fp, $name);
        fclose($fp);
        $date_cmd = escapeshellcmd("death_date.py");
        $death_date = shell_exec($date_cmd);
        echo '<h1 id="h1"><div style="color: white">'.$name." has already been sent to hell "."$death_date"."</div></h1>";
        echo '<h2 id="h2"><div style="color: white">'."Here is what $name looks like now"."</div></h2>";
        $photo = shell_exec("get_random_pic.py");
        echo '<h3 id="h3"><img src="'.$photo.'" alt="dead person" style="width:700px;height:400px;"></h3>';
    }
    else {
        date_default_timezone_set('Australia/Sydney');
        $date = date("l jS \of F Y h:i:s A");
        echo '<h1 id="h1"><div style="color: white">The person who is sent to hell is '.$name." on "."$date"."</div></h1>";
        echo '<h2 id="h2"><div style="color: white">'."They are now ferried to hell"."</div></h2>";
        shell_exec("next_death_time.py");
        echo '<h3 id="h3"><img src="boat_to_hell.jpg" alt="boat to hell" style="width:700px;height:400px;"></h3>';
    }
    #echo "<p style="color: white">The person who is sent to hell is:</p>"; 
?>
<!--<h3> style="color:white;">Your grievance shall be avenged.<img src = "ash_dizzy.jpg" alt = "dead person" style = "width:500px;height:600px;"> </h3>  -->

<?php
    #echo "<link rel = 'stylesheet' href = 'names.css'/>";
    echo '<p id="clock"></p>';
    if (filesize('times.txt') != 0) {
        $common_day = shell_exec("common_day.py");
        echo '<p id="day" style="color: white">'.'The most common day where someone is sent to hell is on a '.$common_day.'</p>';
    }
    else {
        echo '<p id="day" style="color: white">'.'Today starts to be the most common day'.'</p>';
    }
    //document.getElementById("clock").innerHTML = "0d 0h 0m 0s";
        //document.getElementById("clock").style.color = "white";
    $data=$_GET['person'];
    date_default_timezone_set('Australia/Sydney');
    $date = date("l jS \of F Y h:i:s A e");
    //echo '<div style="color: white">'.$date.'</div>';
    //fwrite($fp, $date);
    //fclose($fp);
    $num_today = shell_exec("in_hell_today.py");
    echo '<h4 id="h4"><div style="color: white">'.$num_today.'</div></h4>';
    $last_cmd = escapeshellcmd("last_line.py");
    $last_death = shell_exec($last_cmd);
    echo '<h5 id="h5"><div style="color: white">'.$last_death.'</div></h5>';
    //echo '<div style="color: white">'."The estimate time for the next person to be sent to hell is: ".$has_times.'</div>';
    if (filesize('times.txt') != 0) {
        $estimate = shell_exec("estimate_time.py");
        echo '<h6 id="h6"><div style="color: white">'."The estimate time for the next person to be sent to hell is in: ".'</div></h6>';
        $check = "length>0";
        //echo '<script type="text/javascript"> estimate_time();</script>';
        //echo '<script type="text/javascript"> alert("HERE1")</script>';
    }
    else {
        echo '<h6 id="h6"><div style="color: white">'."Not enough sample to tell the estimate time for next person to be sent to hell.".'</div></h6>';
        echo '<script type="text/javascript"> document.getElementById("clock").innerHTML =  "0d 0h 0m 0s";
        document.getElementById("clock").style.color = "white"; </script>';
        $check = "1";
    }
    //echo '<div style="color: white">'."THIS IS $check".'</div>';
    #$date = date("l jS \of F Y h:i:s A e");
    $new_line = "\n";
    $write = $data.'|'.$date.$new_line;
    $fp = fopen('data.txt', 'a');
    if (!empty($data) and !str_contains(file_get_contents("data.txt"), $name)) {
        fwrite($fp, $write);
    }
    fclose($fp);
?>
<script type="text/javascript">
    //document.getElementById("clock").style.visibility = "visible";
    var checker  = <?php echo json_encode($check); ?>;
    var length = checker.length;
    if (length != 1) {
        var total = <?php echo json_encode($estimate); ?>;
        var total_in_sec = parseInt(total);
        var x = setInterval(() => {
            var days = Math.floor(total_in_sec / (60 * 60 * 24));
            var hours = Math.floor((total_in_sec % (60 * 60 * 24)) / (60 * 60));
            var minutes = Math.floor((total_in_sec % (60 * 60)) / (60));
            var seconds = Math.floor(total_in_sec % (60));
            document.getElementById("clock").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s";
            document.getElementById("clock").style.color = "white";
            if (total_in_sec < 0) {
                clearInterval(x);
                document.getElementById("clock").innerHTML = "0d 0h 0m 0s";
            }
            total_in_sec -= 1;
        }, 1000);    
    }
</script>


</body>
</head>
</html>