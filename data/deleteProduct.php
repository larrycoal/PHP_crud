<?php
    require('db_conn.php');

    $error = null;

    if(!empty($_GET['productId'])){
        $productId = $_GET['productId'];
    } else {
        $productId = null;
        $error = "<p> Error! User Id not found!</p>";
    }

    if($error == null){
        
        $query = "DELETE FROM products WHERE productId = '$productId' ;";
        
        $result = mysqli_query($dbc, $query);
        
        if($result){
            header("Location: index.php");
       
            exit;
        } else {
            echo "</br><p>Some error in Deleting the record</p>";
        }
        
    } else{
        echo "Somethinng went wrong. The error is : $error";
    }
?>