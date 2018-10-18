<?php
$page_title = "Edit Profile";
include_once 'partials/headers.php';
include_once 'partials/parseProfile.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<div class="container">
<div class="jumbotron">
  <?php if(!isset($_SESSION['username'])): ?>
  <P class="lead">You are not authorized to view this page <a href="login.php">Login</a>
      Not yet a NeRV member? <a href="signup.php">Signup</a> </P>
  <?php else: ?>
    <h2>Edit Profile</h2>
    <hr/>
    <div>
      <?php if(isset($result)) echo $result;?>
      <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
    </div>
    <div class="clearfix">
    </div>
    <form method="post" action="" enctype="multipart/form-data">
      <div class="form-group">
      <label for="emailField">Email:</label>
      <input type="text" name="email" class="form-control" id="emailField" value="<?php if(isset($email)) echo $email; ?>">
      </div>
      <div class="form-group">
      <label for="usernameField">Username:</label>
      <input type="text" name="username" class="form-control" id="usernameField" value="<?php if(isset($username)) echo $username; ?>">
      </div>
      <div class="form-group">
      <label for="passwordField">Password:</label>
      <input type="text" name="password" class="form-control" id="passwordField" value="<?php if(isset($password)) echo $password; ?>">
      </div>
      <div class="form-group">
      <label for="firstnameField">Firstname:</label>
      <input type="text" name="first_name" class="form-control" id="firstnameField" value="<?php if(isset($firstname)) echo $firstname; ?>">
      </div>
      <div class="form-group">
      <label for="LastnameField">Lastname:</label>
      <input type="text" name="last_name" class="form-control" id="LastnameField" value="<?php if(isset($lastname)) echo $lastname; ?>">
      </div>
      <div class="form-group">
      <label for="PhoneField">Phone:</label>
      <input type="text" name="phone" class="form-control" id="PhoneField" value="<?php if(isset($phone)) echo $phone; ?>">
      </div>
      <div class="form-group">
      <label for="AddressField">Address:</label>
      <input type="text" name="address" class="form-control" id="AddressField" value="<?php if(isset($address)) echo $address; ?>">
      </div>
      <div class="form-group">
      <label for="CityField">City:</label>
      <input type="text" name="city" class="form-control" id="CityField" value="<?php if(isset($city)) echo $city; ?>">
      </div>
      <div class="form-group">
      <label for="PostcodeField">Postcode:</label>
      <input type="text" name="postcode" class="form-control" id="PostcodeField" value="<?php if(isset($postcode)) echo $postcode; ?>">
      </div>
        <div class="form-group">
        <label for="fileField">Image</label>
        <input type="file" name="image" class="form-control" id="imageField">
        </div>
        <input type="hidden" name="hidden_id" value="<?php if(isset($id)) echo $id; ?>">
        <button type="submit" name="updateProfileButton" class="btn-primary pull-right">Update Profile</button>
        <?php ?>
      </form>
    <?php endif ?>

  </div>
  </div>
<?php include_once 'partials/footer.php';?>
