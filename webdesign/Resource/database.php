<?php
//initialse varibales to hold connection parameters
$dsn = 'mysql:host=localhost; dbname=student18';
$username = 'student18';
$password = 'indigo65';
  try
    {
      //create an instance of the PDO class with the required parameters
      $db = new PDO($dsn, $username, $password);
      //set pdo error mode to exception
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //display success message
      //echo "Connected to the database";
    }
  catch (PDOException $ex)
    { //display error message
      echo "Connection failed".$ex->getMessage();
    }
?>
