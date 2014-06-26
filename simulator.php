<?php

/*  Temperature is expressed in degrees Fahrenheit. */

function getSimulatedTemperature($step) {

    if ($step <= 10)
        $t = 68.0 + ($step * 0.3);
    else
        $t = 71.0 - ($step * 0.6);
    return $t;

}