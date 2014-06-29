<!-- weather.php
       Displays the weather page, retrieving variables to display weather data.
-->

<?php

    require_once 'weatherfunctions.php';
    
    // phpinfo();

    $curDisplayTemp = getCurTemperature();
    $displayScale = getScale();
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="weather.css">

<script type="text/javascript">

blinkState = 0;

function blinkHRs() {

    hrs = document.getElementsByClassName("hrules");

    for (i = 0; i < hrs.length; i++) {
        if (blinkState) {
            hrs[i].style.color = "#0000FF";
	}
	else {
	    hrs[i].style.color = "#FF0000";
	}
    }    
    blinkState = ! blinkState;
}

function refreshData() {

    // Phase 1: just figure out how to update the DIV.
    // Phase 2: update the DIV with new data retrieved from the server.
    
    var newTemperature = +document.getElementById("displayedTemperature").value;
    newTemperature += 0.1;
    document.getElementById("displayedTemperature").value = newTemperature;    // TO DO: This goes away once we retrieve the data from the server.

    document.getElementById("temperatureDataCell").innerHTML = newTemperature.toFixed(1) + " degrees " + "<?php echo $displayScale ?>";

    blinkHRs();

}

function setScale() {

alert("Click refresh for scale change to take effect.");
// TO DO : make scale change upon radio button selection.
//              Will need to call refreshData();

}


function startTimer() {
    setInterval("refreshData()", 3000);
}

</script>

<title>Weather</title>
</head>
<body onload="startTimer()">
<div id="WeatherCurData"> 
<table>
<tr>
<td>Current Temperature:</td>
<td id=temperatureDataCell>
    <?php echo number_format($curDisplayTemp,1) . " degrees $displayScale" ?>
</td>
</tr>
</table>
<div id="Controls">
<form name="mainWeatherForm" action="<?php echo $PHP_SELF;?>" method="post">
<br/>
<table>
<tr>
<td>
<input type="submit" name="refresh" value="refresh">
</td><td>
<input type="checkbox" name="historyOn" <?php if ($showHistory) {echo 'CHECKED';} ?>>
view history
</td>
</tr><tr>
<td>
<br/>
Scale:
<input type="radio" name="scale" id="scaleFselected" value="F" <?php if ($scale=='F') {echo 'CHECKED';} ?> onclick="setScale()"> F
<input type="radio" name="scale" id="scaleCselected" value="C" <?php if ($scale=='C') {echo 'CHECKED';} ?> onclick="setScale()"> C
<input type="hidden" name="iteration" id="iteration" value="<?php echo $iteration;?>">
<!-- TO DO: the displayedTemperature hidden input can go away once we retrieve data from the server. -->
<input type="hidden" id="displayedTemperature" value=<?php echo number_format($curDisplayTemp,1) ?>>
<input type="hidden" id="displayedScale" value="<?php echo $scale ?>">
</td>
</tr>
</table>
<br/>
</form>
</div>
<div id ="WeatherHistory" <?php if ($showHistory=='True') {} else {?>style="display:none"<?php } ?>>
<br/>
<hr id="hr1" class="hrules" />
<br/>History will eventually be displayed here.
</div>
<div id="DebugDiv">
<br/>
<hr id="hr2" class="hrules" />
<br/>
DEBUGGING INFORMATION:
<p>Iteration:       <?php echo $iteration      ?>  </p>
</div>
</body>
</html>
