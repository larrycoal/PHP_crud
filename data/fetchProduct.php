<?php
require 'db_conn.php';
session_start();
unset($_SESSION['product']);

$error = null;
if (!empty($_GET['productId'])) {
 $productId = $_GET['productId'];
} else {
 $productId = null;
 $error     = "<p> Error! product Id not found.";
}

if ($error == null) {
 $query  = "SELECT * FROM products WHERE ProductId = $productId;"; // replace with paramertized query using mysqli_stmt_bind_param
 $result = @mysqli_query($dbc, $query);

 if (mysqli_num_rows($result) == 1) {
  $row                 = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $_SESSION['product'] = $row;
  echo json_encode($row);

 } // else-> inccorect entry in db
} else {
 echo $error;
}
header("location:index.php");
?>