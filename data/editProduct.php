<?php
require 'db_conn.php';
$errors = [];
$addedBy            = $_POST['adminName'];
$productName        = $_POST['productName'];
$quantityAvailable  = $_POST['quantityAvailable'];
$price              = $_POST['price'];
$productDescription = $_POST['productDescription'];
$productId = $_GET['productId'];

if (empty($productId)) {
    echo "<h1>SOMETHING WENT WRONG</h1>";
} 
 if (empty($addedBy)) {
 $errors["addedByErr"] = "Name is required";
}
;

if (empty($productName)) {
 $errors["productNameErr"] = "product name is required";
}
;
if (empty($quantityAvailable)) {
 $errors["quantityAvailableErr"] = "quantity available is required";
}
;
if (empty($price)) {
 $errors["priceErr"] = "price is required";
}

if (empty($productDescription)) {
 $errors["productDescriptionErr"] = "product description is required";
}

if (count($errors) == 0) {
 $addedBy_clean            = prepare_string($dbc, $addedBy);
 $productName_clean        = prepare_string($dbc, $productName);
 $productDescription_clean = prepare_string($dbc, $productDescription);
 $quantityAvailable_clean  = prepare_string($dbc, $quantityAvailable);
 $price_clean              = prepare_string($dbc, $price);
 

 $query = "UPDATE products SET ProductName = ?, ProductDescription = ?, QuantityAvailable = ?, Price = ?,AddedBy=? WHERE  productId = ?;";

 $stmt = mysqli_prepare($dbc, $query);

 mysqli_stmt_bind_param(
  $stmt,
  'ssssss',
  $productName_clean,
  $productDescription_clean,
  $quantityAvailable_clean,
  $price_clean,
  $addedBy_clean,
  $productId
 );

 $result = mysqli_stmt_execute($stmt);

 if ($result) {
  header("Location: index.php");
  exit;
 } else {
  echo "</br>Some error in Saving the data";
 }
} else {
 $_SESSION['error'] = $errors;
 header("location:index.php");
}



?>

