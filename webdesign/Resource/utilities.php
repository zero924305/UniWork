<?php

///check the empty valuable in the required fuelds
function check_empty_fields($required_fields_array)
{
  $form_errors = array();
  foreach ($required_fields_array as $name_of_field)
  {
    if(!isset($_POST[$name_of_field])||$_POST[$name_of_field]==NULL)
    {
      ///Display Error Message
      $form_errors[] = $name_of_field . " is a required field.";
    }
  }
  return $form_errors;
}
///Check the lenght of the valuable
function check_min_length($fields_to_check_length)
{
  $form_errors = array();

  foreach ($fields_to_check_length as $name_of_field =>$minimum_length_required)
  {
    if(strlen(trim($_POST[$name_of_field])) < $minimum_length_required)
    {
      /// Display Error Message
      $form_errors[] = $name_of_field . " is too short, must be {$minimum_length_required} characters long";
    }
  }
  return $form_errors;
}
///Check Email formart
function check_email($data)
{
  $form_errors = array();

      if(!filter_var($data,FILTER_VALIDATE_EMAIL))
      {
        $form_errors[] = "Your email address is invalid.";
      }

  return $form_errors;
}

function check_contact_email($data)
{
  $form_errors = array();

      if(!filter_var($data,FILTER_VALIDATE_EMAIL))
      {
        $form_errors[] = "Please enter 'Email', 'Name' and 'Message' to send.";
      }
  return $form_errors;
}

/// The style formate of error
function show_errors($form_errors_array)
{
  $errors = "<p><ul style ='color: red;'>";

  foreach ($form_errors_array as $the_error)
  {
    $errors .="<li> {$the_error} </li>";
  }
  $errors .="</ul></p>";
  return $errors;
}

///Check the password valuable
function conform_password()
{
  if(empty($form_errors))
  {
    $email = $_POST['email'];
    $password1 = $_POST['new_password'];
    $password2 = $_POST['confirm_password'];

    if($password1 !=$password2)
    {
      $result = flashMessage("New password and confirm password does not much");
    }
  }
}

///display flash Message after the user has complete the application form
function flashMessage($message, $passOrFail = "Fail")
{
  if($passOrFail === "Pass")
  {
    $data = "<div class='alert alert-success'>{$message}</p>";
  }
  else
  {
    $data = "<div class='alert alert-danger'>{$message}</p>";
  }
  return $data;
}

///function redirect to index page
function redirectTo($page)
{
  header("Location:{$page}.php");
}

///check any duplication data in the database
function checkDuplication($table, $column_name ,$value,$db)
{
  try {
    $sqlQuery = "SELECT * FROM ".$table. " WHERE  $column_name=:$column_name";
    $statement = $db->prepare($sqlQuery);
    $statement->execute(array(':$column_name' =>$value));
    if($row = $statement->fetch())
    {
      return true;
    }
  } catch (Exception $ex) {
    //handel exception

  }
}

//rememberMe function
function rememberMe($user_id)
{
  $encryptCookieData = base64_encode("UaQteh5i4y3dntstemYODEC{$user_id}");
  // cookie set to expire in about 30 days
  setcookie("rememberUserCookie",$encryptCookieData, time()+60*60*24*100, "/");
}

/*
* check if the cookie used is same with the encrypted cookie
* @param $db, database connection link
* @return bool, true if the user cookie is valid
*/
function isCookieVaild($db)
{
  $isVaild = false;

  if(isset($_COOKIE['rememberUserCookie']))
  {
    //Decade cookie and extract user ID
    $decryptCookieData = base64_decode($_COOKIE['rememberUserCookie']);
    $user_id = explode("UaQteh5i4y3dntstemYODEC", $decryptCookieData);
    $userID = $user_id[1];

    //check if id retrieved from the cookie exist in the database
    $sqlQuery = "SELECT * FROM users WHERE user_id =:user_id";
    $statement = $db->prepare($sqlQuery);
    $statement->execute(array(':user_id' => $userID));

    if($row = $statement->fetch())
    {
      $id =$row['user_id'];
      $username = $row['username'];
      /*
      * create the user session variable
      */
      $_SESSION['user_id'] = $id;
      $_SESSION['username'] = $username;
      $isValid = true;
    }
    else
    {
      /*
      *cookie ID is invalid destroy sesion and logout user
      */
      $isvalid = false;
      signout();
    }
  }
  return $isvalid;
}

//logout function
function signout()
{
  unset($_SESSION['username']);
  unset($_SESSION['user_id']);

  if(isset($_COOKIE['rememberUserCookie']))
  {
    unset($_COOKIE['rememberUserCookie']);
    setcookie('remeberUserCookie', null, -1, '/');
  }
  session_destroy();
  session_regenerate_id(true);
  redirectTo('index');
}
function guard()
{
  $isValid = true;
  $inactive = 60 * 5; //5min
  $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

  if((isset($_SESSION['fingerprint']) && $_SESSION['fingerprint'] != $fingerprint))
  {
    $isValid = false;
    signout();
  }
  else if((isset($_SESSION['last_active']) && (time() - $_SESSION['last_active'])> $inactive) && $_SESSION['username'])
  {
    $isValid = false;
    signout();
  }
  else
  {
    $_SESSION['last_active'] = time();
  }
  return $isValid;
}

function isValidImage($file)
{
  $form_errors = array();

  //split file name into an array using the dot (.)
  $part = explode(".",$file);

  //target the last element in the array
  $extension = end($part);

  switch(strtolower($extension))
  {
    case 'jpg':
    case 'png':
    case 'bmp':
    case 'gif':

    return $form_errors;
  }
  $form_errors[] = $extension . " is not a valid image extension";
  return $form_errors;
}

function uploadImage($username)
{
  $isImageMoved = false;

  if($_FILES['image']['name'])
  {
    $temp_file = $_FILES['image']['tmp_name'];
    $ds = DIRECTORY_SEPARATOR;//uploads
    $image_name = $username.".jpg";

    $path = "uploads".$ds.$avatar_name;//uploads/demo.jpg

    if(move_uploaded_file($temp_file, $path))
    {
      $isImageMoved=true;
    }
  }
return $isImageMoved;
}
function mk_dir($dir="")
{
  if(empty($dir)) die("no dir name");
  if(!is_dir($dir))
  {
    umask(000);
    if(!mkdir($dir,0777)) die("cannot create folder");
  }
}
function save_product_pic($product_id = "")
{
  if(!isset($_FILES['product_image']['tmp_name']))
  {
    return;
  }else if(empty($product_id))
  {
    die("Product ID did not exist.");
  }
  mk_dir('uploads');
  if(move_uploaded_file($_FILES['product_image'],"uploads/{$product_id}.jpg"))
  {
    return true;
  }
  return false;
}

function get_product_image($product_id ='',$type="product")
{
  $filename = "uploads/{$type}/{$product_id}.png";
  if(file_exists($filename))
  {
    return $filename;
  }
  else {
    $size = ($type == '') ? "300x200" :"600x400";
    return "http://dummyimage.com/{$size}/889dd1/ffffff.gif&text=noproductimage";
  }
}

?>
