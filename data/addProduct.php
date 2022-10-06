<?php
require 'db_conn.php';
session_start();

$addedBy = $_POST['adminName'];
$productName  = $_POST['productName'];
$quantityAvailable= $_POST['quantityAvailable'];
$price   = $_POST['price'];
$productDescription = $_POST['productDescription'];
$errors       = [];

if (!empty($addedBy)) {
 if (!is_text_only($addedBy)) {
  $errors["addedByErr"] = "Name can only accept text";
 }
} else {
 $errors["addedByErr"] = "Name is required";
}
;

if (empty($productName)) {
 $errors["productNameErr"] = "product name is required";
}
;
if (empty($quantityAvailable)) {
 $errors["quantityAvailableErr"] = "quantity available is required";
};
if (empty($price)) {
 $errors["priceErr"] = "price is required";
}

if (empty($productDescription)) {
 $errors["productDescriptionErr"] = "product description is required";
}


if (count($errors) == 0) {
$addedBy_clean     = prepare_string($dbc, $addedBy);
$productName_clean    = prepare_string($dbc, $productName);
$productDescription_clean    = prepare_string($dbc, $productDescription);
$quantityAvailable_clean = prepare_string($dbc, $quantityAvailable);
$price_clean = prepare_string($dbc, $price);


$query = "INSERT INTO products(ProductName, ProductDescription, QuantityAvailable, Price, AddedBy) VALUES (?,?,?,?,?)";

$stmt = mysqli_prepare($dbc, $query);

mysqli_stmt_bind_param(
 $stmt,
 'sssss',
 $productName_clean,
 $productDescription_clean,
 $quantityAvailable_clean,
 $price_clean,
 $addedBy_clean
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


function is_text_only($input_value)
{
 if (!preg_match("/[^a-zA-Z- ]/", $input_value)) {
  return true;
 } else {
  return false;
 }
}

