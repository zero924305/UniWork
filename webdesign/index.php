<?php
$page_title ="NeRV|Home";
include_once 'partials/headers.php'
?>
<div class="container">
    <div class="jumbotron">
    <div class="row">
                  <?php
                    $sqlQuery = "SELECT * FROM product";
                    $statement = $db->prepare($sqlQuery);
                    $statement->execute(array());
                    while($row=$statement->fetch())
                    {
                      echo '<div class="col-md-4">';
                      echo "<h3>".$row["product_name"]."</h3>";
                      echo '<hr />'; ?> <img src="<?php echo $row["product_image"]; ?>" class="" height="100%" width="100%" >
                      <?php echo "<br />";
                      echo "<h3>Description:".$row["product_description"]."</h3>";
                      echo ""; echo "Product Price: &pound;".$row["product_price"]; echo "<br />";
                      echo ""; echo "Product Quantity: ".$row["product_quantity"];
                      echo '<p><a href="basket.php" class="btn btn-lg btn-primary" role="button">Go to basket &raquo;</a></p>';
                      echo '</div>';
                    }
                  ?>
    </div>
  </div>
</div>
<?php include_once 'partials/footer.php' ?>
