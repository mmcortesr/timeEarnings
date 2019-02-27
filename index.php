<?php
session_start();
?>
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
        <div class="container">
            <h1 class="display-5">What are your Daily Earnings?</h1>
              <p class="lead"> How much do you earn in different periods? </p>

            <form name ="myForm" action="earnings.php"
                  onsubmit="return validateForm()" method="post">
                <div class="form-group row">
                    <label for="hours" class="col-sm-1 col-form-label">Annual Salary</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" name="wage">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hours" class="col-sm-1 col-form-label">Hours</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" name="hours" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8">
                        <input class="btn btn-outline-secondary btn-lg" type="submit" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>