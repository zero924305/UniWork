<?php
$page_title = "NeRV|Profile";
include_once 'partials/headers.php';
include_once 'partials/parseProfile.php';
?>

<section class="container">
      <?php if(!isset($_SESSION['username'])): ?>
        <section class="jumbotron">
      <P class="lead">You are not authorized to view this page <a href="login.php">Login</a>
          Not yet a NeRV member? <a href="signup.php">Signup</a> </P>
        </section>
      <?php else: ?>
<section class="jumbotron">
        <h2>Profile</h2>
        <hr/>
        <section>
          <?php if(isset($result)) echo $result;?>
          <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
        </section>
        <section class="clearfix">
        </section>
            <section class="col col-lg-7">
                <section class="row col-lg-3" style="margin-bottom: 10px;">
                    <img src="<?php if(isset($profile_picture)) echo $profile_picture; ?>" class="img img-rounded" width="200"/>
                </section>
                <table class="table table-bordered table-condensed">
                    <tr><th style="width: 20%;">Username:</th><td><?php if(isset($username)) echo $username; ?></td></tr>
                    <tr><th>Email:</th><td><?php if(isset($email)) echo $email; ?></td></tr>
                    <tr><th>Firstname:</th><td><?php if(isset($first_name)) echo $first_name; ?></td></tr>
                    <tr><th>Lastname:</th><td><?php if(isset($last_name)) echo $last_name; ?></td></tr>
                    <tr><th>Phone:</th><td><?php if(isset($phone)) echo $phone; ?></td></tr>
                    <tr><th>Address:</th><td><?php if(isset($address)) echo $address; ?></td></tr>
                    <tr><th>City:</th><td><?php if(isset($city)) echo $city; ?></td></tr>
                    <tr><th>Postcode:</th><td><?php if(isset($postcode)) echo $postcode; ?></td></tr>
                    <tr><th>Date Joined:</th><td><?php if(isset($date_joined)) echo $date_joined; ?></td></tr>
                    <tr><th></th><td>
                            <a class="" href="edit-profile.php?user_identity=<?php if(isset($encode_id)) echo $encode_id; ?>">
                                <span class="glyphicon glyphicon-edit"></span>Edit Profile</a> &nbsp; &nbsp;
                            <a class="" href="update-password.php?user_identity=<?php if(isset($encode_id)) echo $encode_id; ?>">
                                <span class="glyphicon glyphicon-edit"></span>Change Password</a> &nbsp; &nbsp;
                        </td></tr>
                </table>
            </section>
          </section>
      <?php endif ?>
</section>
<?php include_once 'partials/footer.php'; ?>
