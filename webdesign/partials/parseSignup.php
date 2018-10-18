<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once'Resource/database.php';
include_once'Resource/utilities.php';


  if(isset($_POST['signupButton']))
  {

    $form_errors=array();
    $required_fields = array('first_name','last_name','email','username','password','address','city','postcode','confirm_password');
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
    $fields_to_check_length = array('username' => 6, 'password'=> 8);
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));
    $form_errors = array_merge($form_errors, check_email($_POST['email']));


    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirm_password'];
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $phonenumber = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];

    if(checkDuplication("users","email",$email,$db))
    {
      $result = flashMessage("Email is already taken, Please try another one.");
    }
    else if(checkDuplication("users","username",$username,$db))
    {
      $result = flashMessage("Username is already taken,Please try another one.");
    }


    else if(empty($form_errors))
    {

      //hashing the password
      $hashed_password = sha1($password);
      //check password and confirm
      if($_POST['password'] != $_POST['confirm_password'])
      {
        $result =flashMessage("password and confirm password does not much");
      }
      try
      {
        $sqlInsert = "INSERT INTO users (username, email, password, first_name, last_name,phone, address, city, postcode, join_date)
                      VALUES (:username, :email, :password, :first_name, :last_name, :phone, :address, :city, :postcode, now())";
        $statement = $db->prepare($sqlInsert);
        $statement->execute(array(':username' =>$username, ':email'=> $email, ':password'=>$hashed_password,':first_name'=>$firstname,':last_name'=>$lastname,':phone'=>$phonenumber,':address'=>$address,':city'=>$city,':postcode'=>$postcode));
        if($statement->rowCount() == 1)
        {
            $result = flashMessage("Registration Successful","Pass");
        }
      }catch (PDOException $ex)
      {
        $result = flashMessage("An error occurred " .$ex->getMessage());
      }
    }
    else
      {
        if(count($form_errors) == 1)
        {
          $result = flashMessage("There was 1 error in the form<br />");
        }
        else
        {
          $result = flashMessage("There were ".count($form_errors)." errors in the form <br />");
        }
      }
  }
?>
