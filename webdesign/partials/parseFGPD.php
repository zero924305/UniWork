<?php

include_once'Resource/database.php';
include_once'Resource/utilities.php';


error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['resetButton']))
{
  $form_errors = array();
  //Form validation
  $reuqire_fields=array('email','newpassword','confirmpassword');
  //use the function to check empty field and merge the return data into form_errors array
  $form_errors = array_merge($form_errors,check_empty_fields($reuqire_fields));
  $fields_to_check_length = array('newpassword'=>8,'confirmpassword'=>8);
  $form_errors = array_merge($form_errors,check_min_length($fields_to_check_length));
  $form_errors = array_merge($form_errors, check_email($_POST['email']));

  if(empty($form_errors))
  {
    $email = $_POST['email'];
    $password1 = $_POST['newpassword'];
    $password2 = $_POST['confirmpassword'];

    if($password1 != $password2)
    {
      $result = flashMessage("New password and confirm password does not match.");
    }
    else
    {
      try{
        $sqlQuery = "SELECT email AND username FROM users WHERE email =:email";
        $statement = $db->prepare($sqlQuery);
        $statement->execute(array(':email' => $email));
        if($statement->rowCount()==1)
        {
          $hashed_password = sha1($password1);
          $sqlUpload ="UPDATE users SET password=:password WHERE email=:email";
          $statement = $db->prepare($sqlUpload);
          $statement->execute(array(':password' =>$hashed_password, ':email' =>$email));
          $result = flashMessage("Password Reset Successful","Pass");
        }
        else
        {
          $result =flashMessage("The email address provided does not exist in our database, please try again.");
        }

      }catch(PDOException $ex)
      {
        $result = flashMessage("An error occurred: ".$ex->getMessage());
      }
    }
  }
  else
  {
    if(count($form_errors)==1)
    {
      $result = flashMessage("There was 1 error in the form");
    }
    else
    {
      $result = flashMessage("There were".count($form_errors)." errors in the form.");
    }
  }
}

?>
