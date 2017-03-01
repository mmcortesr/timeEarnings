<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require('calculations.php');
?>
<html>
    <head>
        <title>earn in a day's </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            p {
                text-align: center;
                font-size: 60px;
            }
        </style>
       <!---<script src="calculations.php"></script>-->
    <p id = "demo" > </p>
    <script>
        //translate seconds to hours
        var initialHours = <?php echo hours() ?> * 60 * 60 * 1000;
        // Set the time we're counting down to
        var deadline= getDeadline(initialHours);
      
        // Update the count down every 1 second
        var intervalOn;
        timeRemaining(deadline);
        var timeInterval = setInterval(function () {
            timeRemaining(deadline); 
            intervalOn=true;
             }, 1000);
             
        //alert(timer + "  ???  " )
        var timer;
          //alert(seconds + "  ???  " )
       
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
            document.getElementById("demo").innerHTML = hours + "h "
                    + minutes + "m " + seconds + "s ";

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(timeInterval);
                document.getElementById("demo").innerHTML = "Time EXPIRED";
            }
        }
        //date
        function getDeadline(time){
            return new Date(Date.parse(new Date()) + time);
            
        }
        function timeSeconds(time){
            
        // Get todays date and current time
            var now = new Date().getTime();  
            
        // Find the distance between now an the deadline
            var countdown = time - now;
            return countdown;
          if (countdown < 0) {
                clearInterval(timeInterval);
                document.getElementById("demo").innerHTML = "Time has EXPIRED";
            }
    }
        
        function toggleTimer() {
            //get countdown in seconds
            if (!intervalOn){
                deadline=getDeadline(timer-1);
                timeRemaining(deadline);
                timeInterval = setInterval(function () {
                    timeRemaining(deadline);}, 1000);
                intervalOn=true;
            }
            else{
              clearInterval(timeInterval);
              intervalOn=false;
              timer = timeSeconds(deadline);
              
              
            }
            
        }
    </script>
</head>   
<button onclick="toggleTimer()">Lunch</button>

<table border="1" style="width:100%">
    <caption>Earnings Calculated</caption>
    <tr>
        <th>Time</th>
        <th>Amount</th>      
    </tr>
    <tr>
        <td>Second</td>
        <td><?php echo secondWage() ?></td>
    </tr>
    <tr>
        <td>Minute</td>
        <td><?php echo minuteWage() ?></td>
    </tr>
    <tr>
        <td>Hourly</td>
        <td><?php echo hourlyWage() ?></td>
    </tr>
    <tr>
        <td>Daily</td>
        <td><?php echo dailyWage() ?></td>
    </tr>
    <tr>
        <td>Weekly</td>
        <td><?php echo weeklyWage() ?></td>
    </tr>
    <tr>
        <td>Monthly</td>
        <td><?php echo monthlyWage() ?> </td>
    </tr>
    <tr>
        <td>Yearly</td>
        <td><?php
echo anualSalary();
?></td>
    </tr>
</table>

</body>
</html>
