<?php

require_once 'simulator.php';

/*  Initial stuff below happens on every load of the page */

$initialScale = 'F';

$iteration = isset($_POST['refresh']) ? $_POST['iteration'] + 1 : 0;

$showHistory = isset($_POST['historyOn']) ? True : False;

$scale = 'F';

if (isset($_POST['scale'])) {
    $scale = ($_POST['scale'] == 'F') ? 'F' : 'C';
}
else {
    $scale = $initialScale;
}

$curTempF = getSimulatedTemperature($iteration);

/* End of initial stuff */

function getCurTemperature() {

    global $scale;
    global $curTempF;
    if ($scale == 'F') {
        return round($curTempF, 1);
    }
    else {
        try {
            $curTempC = ($curTempF - 32.0) * 5.0 / 9.0;
        }
	catch (Exception $e) {
	    if (($curTempF > 31.9) and ($curTempF < 32.1)) {
	        $curTempC = 0.0;
	    }
        }
        return round($curTempC, 1);
    }
}

function getScale() {
    global $scale;
    return $scale;
}

function changeScale() {
    global $scale;
    $scale == 'F' ? $scale = 'C' : $scale = 'F';
}
?>
