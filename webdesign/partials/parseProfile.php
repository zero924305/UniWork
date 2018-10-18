<?php
include_once 'Resource/database.php';
include_once 'Resource/utilities.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if((isset($_SESSION['user_id']) || isset($_GET['user_identity'])) && !isset($_POST['updateProfileButton']))
{
    if(isset($_GET['user_identity']))
    {
        $url_encoded_id = $_GET['user_identity'];
        $decode_id = base64_decode($url_encoded_id);
        $user_id_array = explode("encodeuserid", $decode_id);
        $id = $user_id_array[1];
    }else{
        $id = $_SESSION['user_id'];
    }

  $sqlQuery = "SELECT * FROM users WHERE user_id =:user_id";
  $statement = $db->prepare($sqlQuery);
  $statement->execute(array(':user_id'=>$id));

  while($row = $statement->fetch())
  {
    $username = $row['username'];
    $email = $row['email'];
    $first_name =$row['first_name'];
    $last_name = $row['last_name'];
    $phone = $row['phone'];
    $address = $row['address'];
    $city = $row['city'];
    $postcode = $row['postcode'];
    $date_joined = strftime("%b %d,%Y", strtotime($row['join_date']));
  }

  $user_pic="uploads/".$username.".jpg";
  $default ="uploads/default.png";

  if(file_exists($user_pic))
  {
    $profile_picture = $user_pic;
  }
  else
  {
    $profile_picture = $default;
  }

  $encode_id = base64_encode("encodeuserid($id)");
}
  else if(isset($_POST['updateProfileButton'],$_POST['token']))
  {
    if(validate_token($_POST['token']))
    {

    $form_errors = array();

    //form validation

    $require_fields = array('username','email','first_name','last_name','phone','address','city','postcode');

    //call the function to check empty filed and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_empty_fields($require_fields));
    $fields_to_check_length=array('username'=>6);
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));
    $form_errors = array_merge($form_errors,check_email($_POST['email']));

    //validate if file has a valid extension
    isset($_FILES['image']['name']) ? $image = $_FILES['image']['name'] : $image = null;

    if($image != null)
    {
      $form_errors = array_merge($form_errors, isValidImage($image));
    }
    $username = $_POST['username'];
    $email = $_POST['email'];
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $phonenumber = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $hidden_id = $_POST['hidden_id'];

    if(empty($form_errors))
    {

      try {
          $sqlUpload = "UPDATE users SET username =:username,email=:email,first_name=:first_name,last_name=:last_name,phone=:phone,address=:address,city=:city,postcode=:postcode WHERE user_id =:user_id";
          $statement = $db->prepare($sqlUpload);
          $statement->execute(array(':username'=>$username,':email'=>$email,':first_name'=>$firstname,':last_name'=>$lastname,':phone'=>$phonenumber,':address'=>$address,':city'=>$city,':postcode'=>$postcode,':user_id'=>$hidden_id));

          if($statement->rowCount()==1||uploadImage($username))
          {
            $result = flashMessage("Profile Upadate Successfully.","Pass");
          }
          else
          {
            $result =flashMessage("You have not mad any changes.");
          }
      }
      catch (PDOException $ex)
      {
        $result = flashMessage("An error occurred in :" .$ex->getMessage());
      }

    }
    else{
      if(count($form_errors)==1)
      {
        $result = flashMessage("There was 1 error in the form<br />");
      }
      else
      {
        $result = flashMessage("There were ".count($form_errors)." errors in the form.<br />");
      }
    }
  }else
  {
    //display error
    $result = flashMessage("This request originates from an unknown source, posible attack");
  }
}
