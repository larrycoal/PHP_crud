<?php
    require('db_conn.php');

    $error = null;
    if(!empty($_GET['user_id'])){
        $user_id = $_GET['user_id'];
    } else {
        $user_id = null;
        $error = "<p> Error! User Id not found.";
    }

    if($error == null){
        $query = "SELECT * FROM users WHERE user_id = $user_id;"; // replace with paramertized query using mysqli_stmt_bind_param
        $result = @mysqli_query($dbc, $query);
        
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $province_selected = $row['province'];
        } // else-> inccorect entry in db
    } else {
        echo $error;
    }

    $provinces = array("ON", "AB", "BC", "MB");
 
    if (($key = array_search($province_selected, $provinces)) !== false) {
        unset($provinces[$key]);
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>
            Updation Form
        </title>
    </head>
    <body>
        <form class="form" action="update_user.php" method="post"  id="update_details_form">
            <div class="subtitle">Please enter the data to update the record in the Database</div>
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
            <div class="input-container ic2">
                <input type="text" class="input" id="name" name="name" value="<?php echo $name; ?>"/>
                <label for="name" class="placeholder">Name</label>
            </div>
            <div class="input-container ic2">
                <input type="text" class="input" id="email" name="email" value="<?php echo $email; ?>"/>
                <label for="email" class="placeholder">Email</label>
            </div>
            <div class="input-container ic2">
                <input type="text" class="input" id="phone" name="phone" value="<?php echo $phone; ?>"/>
                <label for="phone" class="placeholder">Phone</label>
            </div>
            <div class="input-container ic2">
                <select class="input" id='province' name='province' >
                    <option selected="selected"><?php echo $province_selected ?> </option>
                    <?php
                        foreach($provinces as $province){
                            echo "<option value='$province'>$province</option>";
                        }
                    ?>
                </select>
                <label for="province" class="placeholder">Province</label>
            </div>
            <button type="submit" class="submit">Update Data</button>
        </form>
    </body>
</html>
