<?php
$page_title ="NeRV|Basket";
include_once 'partials/headers.php';

	if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"],"item_id");
		if(!in_array($_GET["id"],$item_array_id))
		{
			$count =count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'=> $_GET["id"],
				'item_name'=> $_POST["product_name"],
				'item_price' => $_POST["product_price"],
				'item_quantity'=> $_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
	}
	else
	{
		$item_array = array(
		'item_id'=> $_GET["id"],
		'item_name'=> $_POST["product_name"],
		'item_price' => $_POST["product_price"],
		'item_quantity'=> $_POST["quantity"]
		);
		$_SESSION{"shopping_cart"}[0]=$item_array;
	}
}

	if(isset($_GET["action"]))
	{
		if($_GET["action"]=="delect")
		{
			foreach ($_SESSION["shopping_cart"] as $key => $values)
			{
				echo $_SESSION["shopping_cart"][$key];

				if($values["item_id"]==$_GET["id"]);
				{
					unset($_SESSION["shopping_cart"][$key]);
				}
				print_r( $_SESSION["shopping_cart"][$key]);
			}
		}
	}

	if(isset($_GET["order"]))
	{
		$item_array = array(
			'item_id'=> $_GET["id"],
			'item_name'=> $_POST["product_name"],
			'item_price' => $_POST["product_price"],
			'item_quantity'=> $_POST["quantity"]
		);
		$statement = "INSERT INTO order (user_id,product_id,product_name, orderquantity, order_date)
									VALUES (;user_id,:product_id:product_name,orderquantity, now())";
		$statement->execute(array(':user_id'=>$_SESSION['user_id'],':product_id'=>$_GET["id"],':product_name' =>$_POST["product_name"],':orderquantity'=>$_POST["quantity"]));
		if($statement->rowCount() == 1)
		{
				redirectTo('order');
		}
		else {
			echo "order fail";
		}
	}

?>
<div class="container">
	    <div class="jumbotron">  <?php if(!isset($_SESSION['username'])): ?>
			  <P class="lead">You are not authorized to view this page <a href="login.php">Login</a>
			      Not yet a NeRV member? <a href="signup.php">Signup</a> </P>
			  <?php else: ?>
      <h3>Shopping Cart</h3>
		<hr/>
<?php
	$sqlQuery = "SELECT * FROM product";
	$statement = $db->prepare($sqlQuery);
	$statement->execute(array());
	while($row=$statement->fetch())
	{
		echo '<div class="col-md-4">
		<form method="post" action="basket.php?action=add&id='.$row["product_id"].'">
		<div>
		<h3 class="text-info">'.$row["product_name"].'</h3>
		<img src="'.$row["product_image"].'" class="img-responsive" height="165" width="340">
		<h4 class="text-danger">Product Price: £'.$row["product_price"].'</h4>
		<h4 class="text-danger">Product Quantity:'.$row["product_quantity"].'</h4>
		<input type="text" name="quantity" class="form-control" value="1">
		<input type="hidden" name="product_name" value="'.$row["product_name"].'">
		<input type="hidden" name="product_price" value="'.$row["product_price"].'">
		<input type="submit" name="add_to_cart" style="margin-top:10px;" class="btn btn-success" value="Add to basket &raquo;">
		</div>
		<br />
		</form>
		</div>';
	}

?>
<div style="clear:both"></div>
<br />
<h3>Order Details</h3>
<div class="table-responsive">
<table class="table table-bordered">
<tr>
	<th width="40%">Item Name</th>
	<th width="10%">Quantity</th>
	<th width="20%">Price</th>
	<th width="15%">Total</th>
	<th width="5%">Action</th>
</tr>
<?php
if(!empty($_SESSION["shopping_cart"]))
{
	$total = 0;
	foreach($_SESSION["shopping_cart"] as $keys=>$values)
	{
		echo '<tr>
		<td>'.$values["item_name"].'</td>
		<td>'.$values["item_quantity"].'</td>
		<td>£'.$values["item_price"].'</td>
		<td>'.number_format($values["item_price"],$values["item_quantity"],2).'</td>
		<td><a href="basket.php?action=delect&id='.$values["item_id"].'"><span class="text-danger">Remove</span></a></td>
		</tr>';
		$total = $total + ($values["item_price"] * $values["item_quantity"]);
	}
	echo "<tr>
			<td colspan='3' align='right'>Total</td>
			<td align=right>£".number_format($total,2)."</td>";
	echo '<a href="order.php"class="btn btn-lg btn-primary" role="button" type="submit" name="order">Order</a></p>';
}
?>
</table>
<?php endif?>
</div>
</div>
</div>
<?php include_once 'partials/footer.php' ?>
