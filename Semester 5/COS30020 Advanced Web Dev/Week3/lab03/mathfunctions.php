<?php
function factorial($n)
{
    $result = 1;
    $factor = $n;
    while ($factor > 1) { // continue while its more than 1
        $result *= $factor; // multiply result by factor
        $factor--; // decrement by 1
    }
    return $result;
}
?>