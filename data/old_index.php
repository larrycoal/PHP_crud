<!DOCTYPE html>

<?php
 $provinces = array("ON", "AB", "BC", "MB");
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>
            Insertion Form
        </title>
    </head>
    <body>
        <form class="form" action="register.php" method="post" id="registration_form">
            <div class="subtitle">Please enter the data to be saved in the Database</div>
            <div class="input-container ic2">
                <input type="text" class="input" id="name" name="name"/>
                <label for="name" class="placeholder">Name</label>
            </div>
            <div class="input-container ic2">
                <input type="text" class="input" id="email" name="email"/>
                <label for="email" class="placeholder">Email</label>
            </div>
            <div class="input-container ic2">
                <input type="text" class="input" id="phone" name="phone"/>
                <label for="phone" class="placeholder">Phone</label>
            </div>
            <div class="input-container ic2">
                <select class="input" id='province' name='province' >
                    <option selected="selected">Choose province</option>
                    <?php 
                        foreach($provinces as $province){
                            echo "<option value='$province'>$province</option>";
                        }
                    ?>
                </select>
                <label for="province" class="placeholder">Province</label>
            </div>
            <button type="submit" class="submit">Insert data into DB</button>
        </form>
    </body>
</html>