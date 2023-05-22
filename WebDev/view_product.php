<?php
include 'config.php';

if (isset($_GET['id'])) {
  $product_id = $_GET['id'];

  // Query to fetch the product details based on the product ID
  $select_product = mysqli_query($conn, "SELECT * FROM `women_products` WHERE id = '$product_id' LIMIT 1") or die('Query failed');

  if (mysqli_num_rows($select_product) > 0) {
    $fetch_product = mysqli_fetch_assoc($select_product);

    // Display the product details
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Product Details</title>
      <!-- Add necessary CSS styles here -->
    </head>
    <body>
      <!-- Display the product details -->
      <h2><?php echo $fetch_product['name']; ?></h2>
      <img src="IMG/<?php echo $fetch_product['image']; ?>" alt="">
      <p>Price: ₱<?php echo $fetch_product['price']; ?></p>
      <!-- Rest of the product details -->

      <a href="women.php">Back to Products</a>

      <!-- Add necessary JavaScript code here -->
    </body>
    </html>
    <?php
  } else {
    echo "Product not found.";
  }
} else {
  echo "Invalid product ID.";
}
?>
