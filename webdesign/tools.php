<?php
 include_once 'Resource/database.php';


$operation = isset($_REQUEST['operation']) ? my_filter($_REQUEST['operation'],"string"): '';
switch ($operation) {
  case 'product_form':
    product_form();
    break;

  case 'insert_product';
  $product_id = insert_product();
  header("location:index.php?product_id={$product_id}");
  break;

}

function product_form()
{

}

function insert_product()
{
  global $db;
  $product_name = $_POST['product_name'];
  $product_description = $_POST['product_description'];
  $product_price = $_POST['product_price'];

  $sqlInsert = "INSERT INTO newproduct(product_name,product_description,product_price,product_date)
                VALUES(:product_name,:product_description,:product_price,:now())";
  $statement = $db->prepare($sqlInsert);
  $statement->execute(array(':product_name' =>$product_name, ':product_description'=> $product_description, ':product_price'=>$product_price));
  $product_id = $statement->insert_id;
  return $product_id;
}

?>
