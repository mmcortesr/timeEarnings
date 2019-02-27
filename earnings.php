<?php
session_start();
require('calculations.php');

if (( filter_input(INPUT_POST, "wage") != NULL) && (( filter_input(INPUT_POST, "hours")))) {
    $_SESSION["wage"] = filter_input(INPUT_POST, "wage");
    $_SESSION["hours"] =filter_input(INPUT_POST, "hours");
} else {
    if (!isset($_SESSION['wage']) && !isset($_SESSION['hours'])) {
        header('Location: index.php');
    }
}

//print_r($_SESSION);

require ('util.html');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>earn in a day's </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <div class="container">
        <div class="col text-center">
            <button type="button" class="btn btn-outline-info btn-lg" id = "timer" > </button>
        </div>
        <br>
        <div class="col text-center">
            <button type="button" class="btn btn-outline-info btn-lg " id = "money"> </button>
        </div>
        <br
    </div>


    <script>
        //translate seconds to hours
        var initialHours = <?php echo hours() ?> * 60 * 60 * 1000;

        // Set the time we're counting down to
        var deadline = getDeadline(initialHours);

        //Money per second
        var monSecond =<?php echo secondWage() ?>;


        var intervalOn;
        timeRemaining(deadline);

        var timeInterval = setInterval(function () {
            timeRemaining(deadline);
            moneySeconds();
            intervalOn = true;
        }, 1000);

        /*var moneyInterval = setInterval(function () {
         moneySeconds();
         intervalOn = true;
         }, 1000);
         **/

        //alert(initialHours + "  ???  " );
        var time;
        //alert(monSecond + "  ???  " );
        //
        function timeRemaining(date) {

            // Get todays date and current time
            var now = new Date().getTime();

            // Find the distance between now an the deadline
            var distance = date - now;

            // Time calculations for days, hours, minutes and seconds
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("timer").innerHTML = hours + "h "
                    + minutes + "m " + seconds + "s ";

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(timeInterval);
                document.getElementById("timer").innerHTML = "Time has EXPIRED";
            }
        }

        function changeButton() // no ';' here
        {
            if (this.value === "Take a Break")
                this.value = "Back to Work";
            else
                this.value = "Take a Break";
        }

        //date
        function getDeadline(time) {
            return new Date(Date.parse(new Date()) + time);

        }

        //
        function getSeconds(time) {

            // Get todays date and current time
            var now = new Date().getTime();

            // Find the distance between now an the deadline
            var countdown = time - now;
            return countdown;
            if (countdown < 0) {
                clearInterval(timeInterval);
                document.getElementById("timer").innerHTML = "Time EXPIRED";
            }
        }

        //
        function moneySeconds() {
            timer = getSeconds(deadline);
            var money = 0;

            money = (money + (initialHours - timer) * monSecond) / 1000;
            if (timer < 0) {
                clearInterval(timeInterval);
                document.getElementById("money").innerHTML = "You earned $" + money.toFixed(3) + " Today!";
            } else {
                document.getElementById("money").innerHTML = "$" + money.toFixed(3);
            }

        }
        //alert(moneySeconds() + "  ???  ");

        function toggleTimer() {
            //get countdown in seconds
            if (!intervalOn) {
                deadline = getDeadline(timer - 1);
                timeRemaining(deadline);
                timeInterval = setInterval(function () {
                    timeRemaining(deadline);
                    moneySeconds();
                }, 1000);

                /**moneyInterval = setInterval(function () {
                 moneySeconds();
                 }, 1000);**/
                intervalOn = true;
            } else {
                clearInterval(timeInterval);
                //clearInterval(moneyInterval);
                intervalOn = false;
                timer = getSeconds(deadline);
            }

        }


    </script>
</head> 
<body>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <button onclick="toggleTimer()" class="btn btn-outline-secondary btn-lg" data-toggle="button" aria-pressed="false" autocomplete="off">Lunch/break</button>
            </div>
        </div>
        <br>
        <div class="row justify-content-md-center">
            <div class="col col-lg-5">
                <table class="table table-sm table-light table-hover table-borderless">
                    <caption> Earnings Calculated </caption>
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Amount $$</th>      
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Per Second</td>
                            <td><?php echo round(secondWage(), 3) ?></td>
                        </tr>
                        <tr>
                            <td> Per Minute</td>
                            <td><?php echo round(minuteWage(), 2) ?></td>
                        </tr>
                        <tr>
                            <td>Hourly Wage</td>
                            <td><?php echo hourlyWage() ?></td>
                        </tr>
                        <tr>
                            <td>Daily Wage</td>
                            <td><?php echo dailyWage() ?></td>
                        </tr>
                        <tr>
                            <td>Weekly Wage</td>
                            <td><?php echo weeklyWage() ?></td>
                        </tr>
                        <tr>
                            <td>Biweekly Wage</td>
                            <td><?php echo byWeeklyWage() ?></td>
                        </tr >
                        <tr>
                            <td>Monthly Wage</td>
                            <td><?php echo monthlyWage() ?> </td>
                        </tr>
                        <tr>
                            <td>Annual Salary</td>
                            <td><?php
                                echo anualSalary();
                                ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
