<?php

include_once 'partials/adminheader.php';
include_once 'partials/edit-product.php';
if (strcmp($_SESSION['username'], "admin123") != 0)
{
  redirectTo('index');
}
?>
<div class="continer">
<section class ="col col-lg-7">
  <h2>Edit Product</h2><hr/>
  <div>
    <?php if(isset($result)) echo $result;?>
    <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
  </div>
  <div class="clearfix">
  </div>
     <?php if(isset($_SESSION['username'])): ?>
    <?php else: ?>
        <form action="" method="post" class="form-horizontal" role="form" enctype="enctype=multipart/form-data">
          <div class="form-group">
            <label class="col-md-2 control-label">Product Name:</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Please Insert Product Name" value="<?php if(isset($name)) echo $name; ?>">
          </div>
        </div>
          <div class="form-group">
              <label class="col-md-2 control-label">Product Description:</label>
              <div class="col-md-10">
                <textarea rows='10' cols="50" class="form-control" name="product_description" id="product_description" placeholder="Please Insert Product Description" value="<?php if(isset($description)) echo $description; ?>"></textarea>
              </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label">Product Price:</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Please Insert Product Price" value="<?php if(isset($price)) echo $price; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label">Product Quantity:</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="product_quantity" id="product_quantity" placeholder="Please Insert Product Quantity" value="<?php if(isset($quantity)) echo $quantity; ?>">
            </div>
          </div>
        <input type="hidden" name="hidden_id" value="<?php if(isset($id)) echo $id;?>">
        <button type="submit" name="updateproductButton" class="btn-primary pull-right">Update product</button>
      </form>
    <?php endif ?>
    <p>
      <a href="index.php">Back</a>
    </p>
  </section>
  </div>
<?php include_once 'partials/footer.php';?>
