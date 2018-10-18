<?php
include_once 'Resource/database.php';
require_once 'partials/headers.php';

 if (!isset($_SESSION['username']))
{
	header('location:login.php');
	return;
}

$error = false;
if(isset($_POST['operation']))
{
$pn=$_POST['product_name'];
$pd=$_POST['product_description'];
$pp=$_POST['product_price'];
$pq=$_POST['product_quantity'];

$target_dir = 'product/art1/';
if (!file_exists($target_dir)) {
    if (!mkdir($target_dir, 0777, true))
	{
		$result = flashMessage("Could not create directory for artist ");
		$error = true;
	}
}
echo $_FILES["fileToUpload"];

//rename file to timestamp
$temp = explode(".", $_FILES["fileToUpload"]["name"]);
$_FILES["fileToUpload"]["name"] = round(microtime(true)). '.' .strtolower(end($temp));

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    $errmsg = "Sorry, only JPG, JPEG, PNG and GIF files are allowed. this file is ".$imageFileType;
    $error = true;
}

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if($check == false) {
	$error = true;
	$errmsg = "file is not an image ";
}
if ($_FILES["fileToUpload"]["size"] > 2000000) {
    $error = true;
	$errmsg = "file is larger that 2000kb ";
}

if (!$error)
{
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $result = flashMessage("The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded to ".$target_file,"Pass");
    } else {
		$errmsg = "Sorry, there was an error uploading your file.";
		$error = true;
    }
}

if (!$error)
{
	try
	{

		$stmt = $db->prepare("INSERT INTO product VALUES (NULL,?,?,?,?,?)");
		$stmt->execute(array($pn, $target_file, $pp, $pq, $pd));
	}

	catch(PDOException $ex) {
		$errmsg = $ex->getMessage();
		$errmsg='SQL error';
		$error = true;
	}
}
}
echo $errmsg;


?>

<div class="container">
    <div class="jumbotron">
      <h3>Upload Item</h3>
      <hr />
      <?php if(!isset($_SESSION['username'])): ?>
      <?php redirectTo('index');?>
      <?php else: ?>
      <div>
        <?php if(isset($result)) echo $result; ?>
        <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>

      </div>
      <div class="clearfix">

      </div>
      <form action="" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        <div class="form-group">
          <label class="col-md-2 control-label">Product Name:</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Please Insert Product Name" value="">
        </div>
      </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Product Description:</label>
            <div class="col-md-10">
              <textarea rows='10' cols="50" class="form-control" name="product_description" id="product_description" placeholder="Please Insert Product Description"></textarea>
            </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label">Product Price:</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Please Insert Product Price" value="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label">Product Quantity:</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="product_quantity" id="product_quantity" placeholder="Please Insert Product Quantity" value="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label">Product image:</label>
          <div class="col-md-10">
            <input type="file" name="fileToUpload" id="fileToUpload">
          </div>
        </div>
        <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" name="operation" class="btn btn-primary">Insert Product</button>
        </div>
        </div>
      </form>
    </div>
    <?php endif ?>
</div>
<?php include_once 'partials/footer.php' ?>
