<?php
include_once 'Resource/database.php';
include_once 'Resource/utilities.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = mysqli_connect('127.0.0.1','student18','indigo65');
mysqli_select_db($con,'student18');
$sql = "SELECT * FROM product";
$records = mysqli_query($con,$sql);

if(isset($_GET['product_identity']))
{
  $id= $_GET['product_identity'];
  $result= mysql_query("SELECT * FROM product");
  $row = mysql_fetch_array($result);
}
if(isset($_POST['newname']))
{
  $newname = $_POST['newname'];
  $newprice = $_POST['newprice'];
  $newquantity = $_POST['newquantity'];
  $newdescription = $_POST['$newdescription'];
  $id = $_POST['id'];
  $sql = "UPDATE product SET product_name ='newname', product_price ='newprice',product_quantity='newquantity',product_description='newdescription' where id = '$id'";
  $res = mysql_query($sql) or die("error:".mysql_error());
  echo "<meta http-equiv='refresh' content='0;url=index.php>";
}

?>
