<?php
$page_title ="NeRV|Sign In";
include_once 'partials/headers.php';
include_once 'partials/parseLogin.php';
?>
  <div class="container">
      <div class="jumbotron">
        <h3>Login</h3>
        <hr />
        <div>
          <?php if(isset($result)) echo $result; ?>
          <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
        </div>
        <div class="clearfix">
        </div>

<form method="post" action="">
  <div class="form-group">
    <label for="usernameField">Username</label>
    <input type="text" class="form-control" name="username" value="<?=(isset($_POST['username']) ? $_POST['username']:'')?>" id="usernameField" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="passwordField">Password</label>
    <input type="password" class="form-control" name="password" value="" id="passwordField" placeholder="Password">
  </div>
  <div>

  </div>
  <a href="forgotpassword.php">Forgot Password?</a>

  <button type="submit" name="loginButton" value="Signin" class="btn btn-success pull-right">Sign in</button>
</form>
    <p>
        <a href="index.php" class="btn btn-info" role="button">Back</a>
    </p>
  </div>
</div>
<?php include_once 'partials/footer.php' ?>
