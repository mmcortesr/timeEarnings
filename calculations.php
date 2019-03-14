<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getInitialHours(){
    return$_SESSION["initialHours"];
}

function getDeadline() {
    return $_SESSION["deadline"];
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