<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function hours(){
     return $_POST["hours"];
}
function anualSalary() {
    return $_POST["wage"];
}

function monthlyWage() {
    return round(anualSalary() / 12, 2);
}

function weeklyWage() {
    return round(anualSalary()/ 52, 2);
}

function dailyWage() {
    return round(weeklyWage()/ 5, 2);
}

function hourlyWage() {
    return round(dailyWage() / 8, 2);
}

function minuteWage() {
    return round(hourlyWage()/ 60, 5);
}

function secondWage() {
    return round(minuteWage()/ 60, 9);
}

?>