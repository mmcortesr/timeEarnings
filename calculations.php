<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (filter_input(INPUT_POST, "secs") != NULL) {
    $_SESSION["secs"] = filter_input(INPUT_POST, "secs");
}
if (filter_input(INPUT_POST, "interval") != NULL) {
    $_SESSION["interval"] = filter_input(INPUT_POST, "interval");
}

//print_r($_SESSION);

function getSecondsRemaining() {
    return $_SESSION["secs"];
}

function getIntervalOn() {
    return $_SESSION["interval"];
}

function getInitialHours() {
    return$_SESSION["initialHours"];
}

function unsetAjaxVars() {
    unset($_SESSION["secs"]);
    unset($_SESSION["interval"]);
}

function getDeadline() {
    $deadline = 0;
    if (getSecondsRemaining() != null) {
        if (getIntervalOn() == 'true') {
            $secsRemaining = ((getSecondsRemaining() / 1000) - time());
            if ($secsRemaining < 0) {
                $deadline = $_SESSION["deadline"];
            } else {
                $deadline = time() + $secsRemaining;
            }
        } else {
            $deadline = (time() + (getSecondsRemaining() / 1000));
        }
        $_SESSION["deadline"] = $deadline;
    } else {
        $deadline = $_SESSION["deadline"];
    }
    unsetAjaxVars();
    return $deadline;
}

function getAnualSalary() {
    return $_SESSION["wage"];
}

function deadline($hours) {
    return time() + ($hours * 60 * 60);
}

function monthlyWage() {
    return round(getAnualSalary() / 12, 2);
}

function weeklyWage() {
    return round(getAnualSalary() / 52, 2);
}

function byWeeklyWage() {
    return round(weeklyWage() * 2, 2);
}

function dailyWage() {
    return round(weeklyWage() / 5, 2);
}

function hourlyWage() {
    return round(dailyWage() / 8, 2);
}

function minuteWage() {
    return round(hourlyWage() / 60, 5);
}

function secondWage() {
    return round(minuteWage() / 60, 9);
}

?>