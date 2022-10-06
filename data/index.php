<?php
require 'db_conn.php';

$query   = 'SELECT * FROM products;'; 
$results = @mysqli_query($dbc, $query); 
session_start();
if (isset($_SESSION['error'])
) {
 $errors = $_SESSION['error'];
};
if(isset($_SESSION['product'])){
  $fetchedProduct = $_SESSION['product'];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Portal</title>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
      integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"
      integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"
      integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="index.css">
  </head>
  <body>
    <header>
      <h2>Admin-Portal</h2>
    </header>
    <main>
      <section class="portal__wrapper">
        <div id="tabs">
          <ul>
            <li><a href="#tabs-1">All Products</a></li>
            <li><a href="#tabs-2">Add Product</a></li>
          </ul>
          <div id="tabs-1">
            <h2>View All Available Products</h2>
            <table class="product__table">
              <thead>
                <tr>
                  <th>Product Id</th>
                  <th>Product Name</th>
                  <th>Product Description</th>
                  <th>Quantity Available</th>
                  <th>Price</th>
                  <th>Added By</th>
                  <th colspan="2">Actions</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                   while ($row = $results->fetch_assoc()) {
                   $str_to_print = "<tr>";
                   $str_to_print .= "<td> {$row['ProductId']}</td>";
                   $str_to_print .= "<td> {$row['ProductName']}</td>";
                   $str_to_print .= "<td> {$row['ProductDescription']}</td>";
                   $str_to_print .= "<td> {$row['QuantityAvailable']}</td>";
                   $str_to_print .= "<td> {$row['Price']}</td>";
                   $str_to_print .= "<td> {$row['AddedBy']}</td>";
                   $str_to_print .= "<td class='edit' id={$row['ProductId']}> Edit</td>";
                   $str_to_print .= "<td class='delete' id={$row['ProductId']}> Delete</td>";
                   "</tr>";

                   echo $str_to_print;
                 }
                 ?>
              </tbody>
            </table>
            <div id="dialog" title="Basic dialog">
             <form action="editProduct.php?productId=<?php echo $fetchedProduct['ProductId'] ?>" method="post" class="dialogForm">
              <div>
                <label for="adminName">Admin Name</label>
                <input 
                type="text" 
                name="adminName" 
                value="<?php echo $fetchedProduct['AddedBy']?>">
              </div>
               <div>
                <label for="productName">Product Name</label>
                <input 
                type="text" 
                name="productName" 
                value="<?php echo $fetchedProduct['ProductName']?>">
              </div>
              <div>
                <label for="quantityAvailable">Quantity Availlable</label>
                <input 
                type="text" 
                name="quantityAvailable" 
                value="<?php echo $fetchedProduct['QuantityAvailable']?>">
              </div>
              <div>
                <label for="price">Price</label>
                <input 
                type="number" 
                name="price" 
                value="<?php echo $fetchedProduct['Price']?>">
              </div>
              <div>
                <label for="productDescription">Product Description</label>
                <textarea 
                name="productDescription" 
                id="productDescription" 
                cols="10" 
                rows="5"
                value="<?php echo $fetchedProduct['ProductDescription']?>"
                ></textarea>
              </div>
              <div>
                <button>Update</button>
              </div>
             </form>
            </div>
          </div>
          <div id="tabs-2" class="addProduct__wrapper">
            <h2>Add New Product</h2>
             <form action="addProduct.php" method="post">
              <section>
                <span>
                  <label for="adminName">Admin Name</label>
                <input type="text" name="adminName" id="adminName" placeholder="Enter your name">
                <p class="error">
                <?php if (isset($_SESSION['error']) && isset($errors['addedByErr'])) {echo $errors['addedByErr'];}?>
                </p>
                </span>
                <span>
                  <label for="productName">Product Name</label>
                <input type="text" name="productName" id="productName" placeholder="Enter product name">
                <p class="error">
                <?php if (isset($_SESSION['error']) && isset($errors['productNameErr'])) {echo $errors['productNameErr'];}?>
                </p>
                </span>
              </section>
              <section>
                <span>
                  <label for="quantityAvailable">Quantity Available</label>
                <input type="number" name="quantityAvailable" id="quantityAvailable" placeholder="Enter Quantity available">
                <p class="error">
                 <?php if (isset($_SESSION['error']) && isset($errors['quantityAvailableErr'])) {echo $errors['quantityAvailableErr'];}?>
                </p>
                </span>
                <span>
                  <label for="price">Price</label>
                <input type="number" name="price" id="price" placeholder="Enter product price">
                <p class="error">
                <?php if (isset($_SESSION['error']) && isset($errors['priceErr'])) {echo $errors['priceErr'];}?>
                </p>
                </span>
              </section>
              <div>
                <label for="productDescription">Product Description</label>
                <textarea name="productDescription" id="productDescription" cols="30" rows="10"></textarea>
                <p class="error">
                 <?php if (isset($_SESSION['error']) && isset($errors['productDescriptionErr'])) {echo $errors['productDescriptionErr'];}?>
                </p>
              </div>
              <div>
                <button>Submit</button>
              </div>
             </form>
          </div>
        </div>
      </section>
    </main>
  </body>
  <script>
    $(function () {
      $("#tabs").tabs();
    });
    $(".edit").click((e)=>{
      
      $.ajax({
      type: "GET",
      url: `fetchProduct.php?productId=${e.target.id}`,
      complete: function(data,status){
        data.then(d=>{
          $(".dialogForm").css("visibility","visible")
          $( "#dialog" ).dialog()
        })
     }
   });
     
    })
     $(".delete").click((e)=>{
      
      $.ajax({
      type: "GET",
      url: `deleteProduct.php?productId=${e.target.id}`,
      complete: function(data,status){
        location.reload()
     }
   });
     
    })
  </script>
</html>
<?php unset($_SESSION['error'])?>
<?php unset($_SESSION['product'])?>

