<?php
$page_title ="NeRV|Reset Password";
include_once 'partials/headers.php';
include_once 'partials/parseFGPD.php';
?>
<div class="container">
  <div class="jumbotron">
    <h3>Forget Password</h3>
    <hr />
    <div>
      <?php if(isset($result)) echo $result; ?>
      <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
    </div>
    <div class="clearfix">
    </div>
  <form method="post" action="" class="form-horizontal" role="form">
    <div class="form-group">
      <label for="emailField">Email:</label>
      <input type="email" value="<?=(isset($_POST['email']) ? $_POST['email']:'')?>" class="form-control" name="email" id="emailField" placeholder="Email">
    </div>
    <div class="form-group">
      <label for="newpasswordField">New Password:</label>
      <input type="password" value="" class="form-control" name="newpassword" id="newpasswordField" placeholder="New Password">
    </div>
    <div class="form-group">
      <label for="confirmpasswordField">Confirm Password:</label>
      <input type="password" value="" class="form-control" name="confirmpassword" id="confirmpasswordField" placeholder="Confirm Password">
    </div>
    <button type="submit" name="resetButton" value="Reset" class="btn btn-success pull-right">Reset Password</button>
  </form>
   <p>
     <a href="index.php" class="btn btn-info" role="button">Back</a>
   </p>
 </div>
</div>
<?php
include_once 'partials/footer.php';
?>
