<?php
$page_title ="NeRV|Admin";
include_once 'Resource/database.php';
require_once 'partials/adminheader.php';
if (strcmp($_SESSION['username'], "admin123") != 0)
{
  redirectTo('index');
}
if(isset($_POST['delete']))
{
	$prodid = $_POST['id'];
	echo $prodid;
  $statement = $db->prepare("DELETE FROM product WHERE product_id = ?");
	$statement->execute(array($prodid));
}
if(isset($_POST['update']))
{
  $con = mysqli_connect('127.0.0.1','student18','indigo65');
  mysqli_select_db($con,'student18');
  $sql = "UPDATE product SET product_name='$_POST[pname]',product_description='$_POST[pdescription]',product_quantity='$_POST[pquantity]',product_price='$_POST[pprice]', WHERE product_id=''$_POST[id]'";
  if(mysqli_query($con,$sql))
  {
    $result = flashMessage("Product not update");
    }
  else {
        $result = flashMessage("Product updated","Pass");
  }

}

?>
<div class="container-fluid">
<div id="main" class="row">
  <?php if(!isset($_SESSION['username'])): ?>
  <?php else: ?>
<hr/>
<?php if(isset($result)) echo $result; ?>
<?php
$con = mysqli_connect('127.0.0.1','student18','indigo65');
mysqli_select_db($con,'student18');
$sql = "SELECT * FROM product";
$records = mysqli_query($con,$sql);
  while($row=mysqli_fetch_array($records))
  {
    echo '<form method="post" action="">';
    echo '<div class="col-md-4">';
    echo '<hr />';
    echo "<input type=text name=pname value='".$row["product_name"]."' />";?>
    <img src="<?php echo $row["product_image"]; ?>" class="" height="100%" width="100%" >
    <?php echo "<br />";
    echo "<input type=text name=pdescription value='".$row["product_description"]."' />";
    echo "<input type=text name=pquantity value='".$row["product_quantity"]."' />";
    echo "<input type=text name=pprice value='".$row["product_price"]."' />";
		echo '<input type="hidden" name="id" value="'. $row["product_id"] .'">';
    echo '<button type=submit name="update" value="update">update</button>';
    echo '<button type="submit" name="delete" value="delete" class="btn btn-success pull-right">delete</button>';
    echo '</div>';
    echo '</form>';

  }
?>
<?php endif; ?>
</div>
</div>
<?php
require_once 'partials/footer.php';
?>
