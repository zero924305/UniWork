<?php
include_once 'Resource/database.php';
include_once 'Resource/utilities.php';

if(isset($_POST['changePasswordBtn'],$_POST['token']))
{
  if(validate_token($_POST['token']))
  {
    $form_errors = array();
    $required_fileds= array('current_password', 'new_password','confirm_password');
    $form_errors = array_merge($form_errors,check_empty_fields($required_fileds));
    $fields_to_check_length=array('new_password'=>8, 'confirm_password'=>6);
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    if(empty($form_errors))
    {
      $id = $_POST['hidden_id'];
      $current_password = $_POST['current_password'];
      $password1 = $_POST['new_password'];
      $password2 = $_POST['confirm_password'];

      if($password1 != $password2)
      {
        $result = flashMessage("New password and confirm password does not match");
      }
      else
      {
        try {

          $sqlSquery = "SELECT password FROM users WHERE user_id = :user_id";
          $statement = $db->prepare($sqlSquery);

          $statement->execute(array(':user_id' =>$id));
          if($row = $statement->fetch())
          {
            $password_from_db = $row['password'];

            if($current_password == $password_from_db)
            {
              $hashed_password = sha1($password1);

              $sqlUpdate = "UPDATE users SET password =:password WHERE user_id =:user_id";
              $statement = $db->prepare($sqlUpdate);
              $statement->execute(array(':password' => $hashed_password, ':user_id' => $id));

              if($statement->rowCount()===1)
              {
                $result = flashMessage("Your password was update successfully","Pass");
              }
              else
              {
                $result = flashMessage("No changer saved");
              }
            }
              else
              {
                $result = flashMessage("Old password is not correct, please try again");
              }
            }
              else
              {
                signout();
              }
        }catch (Exception $ex) {
           $result = flashMessage("An error occurred: " .$ex->getMessage());
        }
      }
    }
        else
        {
          if(count($form_errors) == 1)
          {
            $result = flashMessage("There was 1 error in teh form");
          }else
          {
             $result = flashMessage("There were " .count($form_errors). " errors in the form <br>");
          }
        }
        }else
      {
        $result = flashMessage("This request originates from an unknown source. ");
      }
    }
?>
