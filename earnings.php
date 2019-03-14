<?php
session_start();
require('calculations.php');

if (( filter_input(INPUT_POST, "wage") != NULL) && ( filter_input(INPUT_POST, "hours") != NULL)){
    $_SESSION["wage"] = filter_input(INPUT_POST, "wage");
    $_SESSION["deadline"] = deadline(filter_input(INPUT_POST, "hours"));
    $_SESSION["initialHours"]=filter_input(INPUT_POST, "hours");
} else {
    if (!isset($_SESSION['wage']) && !isset($_SESSION['deadline']) && !isset($_SESSION['initialHours'])) {
        header('Location: index.php');
    }
}

//print_r($_SESSION);

require ('util.html');
?>
<!DOCTYPE html>
<html>
    <head>
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
        //translate hours into seconds
        var initialSecs= <?php echo getInitialHours() ?> * 60 * 60 * 1000;
        //console.log(initialSecs + "Initial hours");
        // Set the time we're counting down to
        var deadline = <?php echo getDeadline() ?> * 1000;

        //Money per second
        var monSecond =<?php echo secondWage() ?>;


        var intervalOn;
        timeRemaining(deadline);
        
        
        var timeInterval = setInterval(function () {
            timeRemaining(deadline);
            earningsSeconds(deadline);
            intervalOn = true;
        }, 1000);

       
        function timeRemaining(deadline) {

            // Get todays date and current time
            var currentTime = new Date().getTime();

            // Find the distance between now an the deadline
            var distance = deadline - currentTime;

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
                document.getElementById("timer").innerHTML = "Today's work hours have ended!";
            }
        }

        //deadline
        function getDeadline(time) {
            return new Date(Date.parse(new Date()) + time);
        }

        //
        function getSeconds(deadline) {
            // Get todays date and current time
            var currentTime = new Date().getTime();

            // Find the distance between now an the deadline
            var secsRemaining = deadline - currentTime;
            return secsRemaining;
        }
        function earningsSeconds(deadline) {
             var secRemaining = getSeconds(deadline);
             var earnings=0;
            //console.log(secRemaining + "remaining Secs");

            if (secRemaining < 0) {
                clearInterval(timeInterval);
                earnings = (earnings + (initialSecs - 0) * monSecond)/ 1000;
                document.getElementById("money").innerHTML = "You've earned $" + earnings.toFixed(3) + " Today!";

            } 
            else {
                 earnings = (earnings + (initialSecs - secRemaining) * monSecond)/ 1000;
                    // Output the result in an element with id="demo"
                 document.getElementById("money").innerHTML = "$" + earnings.toFixed(3);
            }
        }

        function toggleTimer() {
            //get countdown in seconds
            if (!intervalOn) {
                deadline = getDeadline(secsRemaining);
                timeRemaining(deadline);
                
                //console.log(deadline);
                //console.log(secsRemaining);
                timeInterval = setInterval(function () {
                    timeRemaining(deadline);
                    earningsSeconds(deadline);
                }, 1000);

                intervalOn = true;
            } else {
                clearInterval(timeInterval);
                intervalOn = false;
                 secsRemaining = getSeconds(deadline);
            }

        }
        function home() {
        location.href = "index.php";
    };


    </script>
</head> 
<body>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <button onclick="home()" class="btn btn-outline-secondary btn-lg" data-toggle="button">back </button>
                <button onclick="toggleTimer()" class="btn btn-outline-secondary btn-lg" data-toggle="button" aria-pressed="false" autocomplete="off">Lunch/break </button>
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
                                echo getAnualSalary();
                                ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
