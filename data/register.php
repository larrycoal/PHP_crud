<?php
    require('db_conn.php');
    $errors = [];

    if(!empty($_POST['name'])){
        $name = $_POST['name'];  
    } else {
        $name = null;
        $errors[] = "<p> Error!!!! Name is required!!</p>";
    }
    if(!empty($_POST['email'])){
        $email = $_POST['email'];  
    } else {
        $email = null;
        $errors[] = "<p> Email is required!!</p>";
    }
    if(!empty($_POST['phone'])){
        $phone = $_POST['phone'];  
    } else {
        $phone = null;
        $errors[] = "<p> Phone is required!!</p>";
    }
    if(!empty($_POST['province'])){
        $province = $_POST['province'];  
    } else {
        $province = null;
        $errors[] = "<p> Province is required!!</p>";
    }

    
   
    if(count($errors) == 0){
        
        $name_clean = prepare_string($dbc, $name);
        $email_clean = prepare_string($dbc, $email);
        $phone_clean = prepare_string($dbc, $phone);
        $province_clean = prepare_string($dbc, $province);
        
        $query = "INSERT INTO users(name , email, phone, province) VALUES (?,?,?,?)";
        
        $stmt = mysqli_prepare($dbc, $query);
        
        mysqli_stmt_bind_param(
            $stmt,
            'ssss',
            $name_clean,
            $email_clean,
            $phone_clean,
            $province_clean
        );
        
        $result = mysqli_stmt_execute($stmt);
        
        if($result){
            header("Location: details.php");
            exit;
        } else {
            echo "</br>Some error in Saving the data";
        }
        
    } else {
        foreach($errors as $error){
            echo $error;
        }
    }
?>



























