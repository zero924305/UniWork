<?php
$page_title = "NeRV|Edit Profile";
include_once 'partials/headers.php';
include_once 'partials/parseProfile.php';
?>

<div class="continer">
<section class ="col col-lg-7">
  <h2>Edit Profile</h2><hr/>
  <div>
    <?php if(isset($result)) echo $result;?>
    <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
  </div>
  <div class="clearfix">
  </div>
     <?php if(isset($_SESSION['username'])): ?>
      <?php redirectTo('index');?>
    <?php else: ?>
      <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
        <label for="emailField">Email</label>
        <input type="email" name="email" class="form-control" id="emailField" value="<?php if(isset($email)) echo $email; ?>">
        </div>
        <div class="form-group">
          <label for="usernameField">Username</label>
          <input type="text" name="username" class="form-control" id="usernameField" value="<?php if(isset($username)) echo $username; ?>">
        </div>
        <div class="form-group">
        <label for="firstnameField">Firstname</label>
        <input type="text" name="text" class="form-control" id="firstnameField" value="<?php if(isset($firstname)) echo $firstname; ?>">
        </div>
        <div class="form-group">
        <label for="lastnameField">Lastname</label>
        <input type="text" name="text" class="form-control" id="lastnameField" value="<?php if(isset($lastname)) echo $lastname; ?>">
        </div>
        <div class="form-group">
        <label for="phoneField">Phone</label>
        <input type="number" name="phone" class="form-control" id="phoneField" value="<?php if(isset($phone)) echo $phone; ?>">
        </div>
        <div class="form-group">
        <label for="addressField">Address</label>
        <input type="text" name="address" class="form-control" id="addressField" value="<?php if(isset($address)) echo $address; ?>">
        </div>
        <div class="form-group">
        <label for="cityField">City</label>
        <input type="text" name="city" class="form-control" id="cityField" value="<?php if(isset($city)) echo $city; ?>">
        </div>
        <div class="form-group">
        <label for="postField">Postcode</label>
        <input type="text" name="postcode" class="form-control" id="postField" value="<?php if(isset($postcode)) echo $postcode; ?>">
        </div>
        <div class="form-group">
        <label for="imageField">Image</label>
        <input type="file" name="image" class="form-control" id="imageField">
        </div>
        <input type="hidden" name="hidden_id" value="<?php if(isset($id)) echo $id;?>">
        <button type="submit" name="updateProfileButton" class="btn-primary pull-right">Update Profile</button>
      </form>
    <?php endif ?>
    <p>
      <a href="index.php">Back</a>
    </p>
  </section>
  </div>
<?php include_once 'partials/footer.php';?>
