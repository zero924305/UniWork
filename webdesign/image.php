<?php include_once'Resource/database.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
  </head>
  <body>
    <?php
    mysql_connect("localhost","student18","indigo65");
    mysql_select_db("student18");
    $res=mysql_query("SELECT * FROM product");
    echo "<table>";
    while($row=mysql_fetch_array($res))
    {
    echo "<td>"; ?> <img src="<?php echo $row["product_image"]; ?>" height="270" width="480"> <?php echo "</td>";
    echo "<td>"; echo $row["product_name"]; echo "</td>";
    echo "<td>"; echo "&pound;".$row["product_price"]; echo "</td>";
    echo "<td>"; echo $row["product_quantity"]; echo "</td>";
    echo "</tr>";
    }
    echo "</table>";
    
    ?>

  </body>
</html>
