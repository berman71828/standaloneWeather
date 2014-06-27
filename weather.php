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
<title>Weather</title>
</head>
<body>
<div id="WeatherCurData"> 
<table>
<tr>
<td>Current Temperature:</td>
<td>
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
<input type="radio" name="scale" value="F" <?php if ($scale=='F') {echo 'CHECKED';} ?>> F
<input type="radio" name="scale" value="C" <?php if ($scale=='C') {echo 'CHECKED';} ?>> C
<input type="hidden" name="iteration" value="<?php echo $iteration;?>">
</td>
</tr>
</table>
<br/>
</form>
</div>
<div id ="WeatherHistory" <?php if ($showHistory=='True') {} else {?>style="display:none"<?php } ?>>
<br/><hr/>
<br/>History will eventually be displayed here.
</div>
<div id="DebugDiv">
<br/>
<hr/>
<br/>
DEBUGGING INFORMATION:
<p>Iteration:       <?php echo $iteration      ?>  </p>
</div>
</body>
</html>
