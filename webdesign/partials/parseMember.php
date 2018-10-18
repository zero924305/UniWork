<?php
try {
$statement = $db->query("SELECT * FROM users");
$members = $statement->fetchAll(PDO::FETCH_ASSOC);

}
catch (PDOExecption $ex)
{
  $result = flashMessage("An error occurred: ".$ex->getMessage());
}

?>
