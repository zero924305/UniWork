<?php
if($_POST['delete'])
  {
    try
    {
    $sql ="DELETE FROM product WHERE id = ";

    $db->exec($sql);
    $result = flashMessage("Record deleted","PASS");
    }
    catch(PDOException $ex)
    {
      $result = flashMessage($sql."<br />".$ex->getMessage());
    }
}
?>
