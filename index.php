<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor-->
<?php
require ('util.html');
?>
<html>
    <head>
        <script>
            function validateForm() {
                var x = document.forms["myForm"]["wage"].value;
                var y = document.forms["myForm"]["hours"].value;
                if ((x === "") || (y === "")) {
                    alert("Textboxes must be filled out");
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <form name ="myForm" action="earnings.php"
              onsubmit="return validateForm()" method="post">
            Annual Salary <input type="text" name="wage"> <br><br>
            Hours: <input type="text" name="hours" value="">
            <br><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>