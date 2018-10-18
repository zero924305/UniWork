<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
  include_once 'Resource/session.php';
  include_once 'Resource/database.php';
  include_once 'Resource/utilities.php';
  if(isset($_POST['loginButton']))
  {
    $form_errors = [];
    $required_fields = array('username', 'password');
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    if(empty($form_errors))
    {
      $user = $_POST['username'];
      $password = sha1($_POST['password']);

      $sqlQuery = "SELECT * FROM users WHERE username =:username AND password =:password";
      $statement = $db->prepare($sqlQuery);
      $statement->execute(array(':username' => $user, ':password' => $password));

      if($row = $statement->fetch())
      {
        $id = $row['user_id'];
        $hashed_password = $row['password'];
        $username = $row['username'];
        
        if (strcmp($_SESSION['username'], "admin123") != 0 && $password == $hashed_password)
        {
          $_SESSION['user_id']=$id;
          $_SESSION['username'] = $username;
          redirectTo('admin');
		  return;
        }
      else if($password == $hashed_password)
         {
          $_SESSION['user_id']=$id;
          $_SESSION['username'] = $username;

          if($remember === "yes")
          {
            rememberMe($id);
          }
          redirectTo('index');
        }
        else
        {
          $result =flashMessage("invalid username or password.");
        }
      }
    }
    else
    {
      if(count($form_errors)==1)
      {
        $result = flashMessage("There was 1 error in the form.");
      }
      else
      {
        $result = flashMessage("There were ".count($form_errors)." errors in the form");
      }
    }
  }
?>
