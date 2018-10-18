<?php
$mysqli = new mysqli("localhost","student18","indigo65","student18");
if($mysqli->connect_error)
{
  die('connection failue('.$mysqli->connect_errno.')'.$mysqli->connect_error);
}
$mysqli->set-charset("utf8");

//upload image
function save_product_pic($product_sn = "")
{
  if(!isset($_FILES['product_pic']['tmp_name']))
  {
    return;
  }
  elseif (empty($product_sn)) {
    die("No product ID! ");
  }
  mk_dir('uploads');
  if(move_uploaded_file($_FILES['product_pic']['tmp_name'], "uploads/{$product_sn}.jpg"))
  {
    return true;
  }
  return false;
}

//create folder
function mk_dir($dir="")
{
  if(empty($dir))die("none folder name");
  if(!is_dir($dir))
  {
    umask(000);
    if(!mkdir($dir,0777))die("cannot create folder");
  }
}
//upload Product
function insert_product()
{

}

switch ($op){
  case 'add_to_cart';
  add_to_cart($goods_sn,$goods_title);
  header("location:index.php");
  exit;
  break;

  default:
  if($goods_sn)
  {
    $op = 'goods_display';
    display_goods($goods_sn);
  }
    else{
      list_goods();
    }
    break;
}

function display_goods($goods_sn = '')
{
  global $mysqli, $smarty;
  add_goods_counter($goods_sn);
  $sql ="SELECT * FROM 'goods' WHERE 'goods_sn' = '{$goods_sn}'";
  $result = $mysqli->query($sql) or die($mysqli->connect_error);

}
?>
