<?php
  $page_title ="NeRV|Registration";
  include_once 'partials/headers.php';
  include_once 'partials/parseSignup.php';
?>
    <div class="container">
      <div class="jumbotron">
        <h3>Create User Account</h3>
        <hr />
        <div>
          <?php if(isset($result)) echo $result; ?>
          <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
        </div>
        <div class="clearfix">
        </div>
        <form method="post" action="">
          <div class="form-group">
            <label for="firstnameField">Firstname:</label>
            <input type="text" value="<?=(isset($_POST['first_name']) ? $_POST['first_name']:'')?>"class="form-control" name="first_name" id="firstnameField" placeholder="Firstname">
          </div>
          <div class="form-group">
            <label for="surnameField">Surname:</label>
            <input type="text" value="<?=(isset($_POST['last_name']) ? $_POST['last_name']:'')?>"class="form-control" name="last_name"id="surnameField" placeholder="Surname">
          </div>
          <div class="form-group">
            <label for="emailField">Email:</label>
            <input type="email" value="<?=(isset($_POST['email']) ? $_POST['email']:'')?>" class="form-control" name="email" id="emailField" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="usernameField">Username:</label>
            <input type="text" value="<?=(isset($_POST['username']) ? $_POST['username']:'')?>" class="form-control" name="username" id="usernameField" placeholder="username">
          </div>
          <div class="form-group">
            <label for="passwordField">Password:</label>
            <input type="password" value="" class="form-control" name="password" id="passwordField" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="confirmpasswordField">Confirm Password:</label>
            <input type="password" value="" class="form-control" name="confirm_password" id="confirmpasswordField" placeholder="Confirm Password">
          </div>
          <div class="form-group">
            <label for="phoneField">Phone:</label>
            <input type="text" value="<?=(isset($_POST['phone']) ? $_POST['phone']:'')?>" class="form-control" name="phone" id="phoneField" placeholder="Phone">
          </div>
          <div class="form-group">
            <label for="addressField">Address:</label>
            <input type="text" value="<?=(isset($_POST['address']) ? $_POST['address']:'')?>" class="form-control" name="address" id="addressField" placeholder="Address">
          </div>
          <div class="form-group">
            <label for="cityField">City:</label>
            <input type="text" value="<?=(isset($_POST['city']) ? $_POST['city']:'')?>" class="form-control" name="city" id="cityField" placeholder="City">
          </div>
          <div class="form-group">
            <label for="postcodeField">Postcode:</label>
            <input type="text" value="<?=(isset($_POST['postcode']) ? $_POST['postcode']:'')?>" class="form-control" name="postcode" id="postcodeField" placeholder="Postcode">
          </div>
          <button type="submit" name="signupButton" value="Signup" class="btn btn-success pull-right">Signup</button>
        </form>
        <p>
          <a href="index.php" class="btn btn-info" role="button">Back</a>
            <a href="artist.php" class="btn btn-danger" role="button">Registration as artist</a>
        </p>
      </div>
    </div>
<?php include_once 'partials/footer.php' ?>
