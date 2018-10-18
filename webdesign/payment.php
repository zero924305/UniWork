<?php
include_once 'Resource/session.php';
include_once 'Resource/database.php';
include_once 'Resource/utilities.php';

if(isset($_POST['submitButton']))
{

  $form_errors=array();
  $required_field = array('card_number','card_name','expire_month','expire_year');
  $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

  if(empty($form_errors))
  {
    $card_number = $_POST['card_number'];
    $card_name = $_POST['card_name'];
    $expiry_month = $_POST['expiry_month'];
    $expiry_year = $_POST['expiry_year'];
      try
      {
          $sqlInsert = "INSERT INTO payment('user_id',card_number,card_name, expiry_month, expiry_year)
                        VALUES (:user_id,:card_nunmber, :card_name, :expiry_month, expiry_year)";
          $statement = $db->prepare($sqlInsert);
          $statement->execute(array($_SESSION['user_id'],':card_nunmber'=>$card_number, ':card_name'=>$card_name, ':expiry_month'=>$expiry_month,':expiry_year'=>$expiry_year));
          if($statement->rowCount()==1)
          {
            $result = flashMessage("Card details has uploaded.","Pass");
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

include_once 'partials/headers.php';
$page_title = "NeRV|Payment";
?>
<div class="container">
    <div class="jumbotron">
      <h3>Card Details</h3>
      <hr />
      <div>
        <?php if(isset($result)) echo $result; ?>
        <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
      </div>
      <div class="clearfix">
      </div>
      <form action="" method="post" class="form-horizontal" role="form">
        <div class="form-group">
          <label class="col-md-2 control-label">Card number:</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="card_number" id="card_number" placeholder="Card Number" size='20'>
        </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label">Card Name:</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="card_name" id="card_name" placeholder="Name on card" size='25'>
        </div>
        </div>
        <div class="form-group">
        <label class="col-md-2 control-label">Expiration:</label>
        <div class="col-md-10">
          <input type="text" class="form-control" name="expiry_month" id="expiry_month" placeholder="MM" size='2'>
        </div>
        <label class="col-md-2 control-label"></label>
        <div class="col-md-10">
        <input type="text" class="form-control" name="expiry_year" id="expiry_year" placeholder="YY" size='2'>
        </div>
        </div>
        <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" name="submitButton" value="Submit" class="btn btn-success pull-right">Upload Card Details</button>
        </div>
        </div>
      </form>
      </div>
  </div>
<?php
include_once 'partials/footer.php';
?>
