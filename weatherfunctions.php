<?php

require_once 'simulator.php';

/*  Initial stuff below happens on every load of the page */

$initialScale = 'F';

if (!isset($_POST['refresh'])) {
    $iteration = 0;
}
else {
    $iteration = $_POST['iteration'] + 1;
}

if (isset($_POST['historyOn'])) {
    $showHistory = True;
}
else {
    $showHistory = False;
}

if (isset($_POST['scale'])) {
    if ($_POST['scale'] == 'F')
        $scale = 'F';
    else
        $scale = 'C';
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
    if ($scale == 'F') {
        $scale = 'C';
    }
    else {
        $scale = 'F';
    }
}

?>
