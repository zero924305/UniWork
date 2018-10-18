<?php

include_once 'Resource/session.php';
include_once 'Resource/database.php';
include_once 'Resource/utilities.php';


if(isset($_POST['submitButton']))
{

  $form_errors=array();
  $required_field = array('email','name');
  $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
  $form_errors = array_merge($form_errors, check_contact_email($_POST['email']));

  if(empty($form_errors))
  {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    try
    {
        $sqlInsert = "INSERT INTO feedback(sender_name,sender_email, sender_message, send_date)
                      VALUES (:name, :email, :message, now())";
        $statement = $db->prepare($sqlInsert);
        $statement->execute(array(':name'=>$name, ':email'=>$email, ':message'=>$message));

        if($statement->rowCount()==1)
        {
          $result = flashMessage("Message has sent, we will reply as soon as possible.","Pass");
        }
    } catch (Exception $e){
      $result = flashMessage("An error occurred: ".$ex->getMessage());
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

$page_title ="NeRV|Contact";
require_once 'partials/headers.php';
?>

  <div class="container">
      <div class="jumbotron">
        <h3>Contact Us</h3>
        <hr />
        <div>
          <?php if(isset($result)) echo $result; ?>
          <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
        </div>
        <div class="clearfix">
        </div>
<form method="post" action="">
  <div class="form-group">
    <label for="nameField">Name</label>
    <input type="text" class="form-control" name="name" id="nameField" placeholder="Name">
  </div>
  <div class="form-group">
    <label for="emailField">Email</label>
    <input type="email" class="form-control" name="email" id="emailField" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="messageField">Message</label>
    <textarea rows='10' cols="50" class="form-control" name="message" value="<?=(isset($_POST['message']) ? $_POST['message']:'')?>" id="messageField" placeholder="Message"></textarea>
  </div>
  <button type="submit" name="submitButton" value="Submit" class="btn btn-success pull-right">Send</button>
</form>
    <p>
        <a href="index.php" class="btn btn-info" role="button">Back</a>
    </p>
  </div>
</div>
<?php include_once 'partials/footer.php' ?>
