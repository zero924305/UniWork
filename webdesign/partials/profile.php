<?php
$page_title = "Profile";
include_once 'partials/headers.php';
include_once 'partials/parseProfile.php';
?>

<div class="container">
  <div>
    <h1>Profile</h1>
    <?php if(isset($_SESSION['username'])):?>
    <p class="lead">
      You are not authorized to view this page <a href="login.php">Login</a>
      Not yet a NeRV member? <a href="signup.php">Signup</a></p>
    </p>
    <?php else: ?>
    <section class="col col-lg-7">
      <table class="table table-bordered table-condensed">
        <tr>
          <th style ="width:20%;">
            Username:</th><td>
              <?php if(isset($username)) echo $username; ?>
            </td>
          </th>
        </tr>
        <tr>
          <th>
            Email:
          </th><td>
            <?php if(isset($email)) echo $email; ?>
          </td>
        </tr>
        <tr>
          <th>
            Date Joined:
          </th><td>
            <?php if(isset($date_joined)) echo $date_joined; ?>
          </td>
        </tr>
        <tr>
          <th>
          </th>
          <td>
            <a class="pull-right" href="edit-profile.php?user_identity=<?php if(isset($encode_id)) echo $encode_id; ?>">
              <span class="glyphicon glyphicon-edit"></span>Edit Profile</a>
          </td>
        </tr>
      </table>
    </section>
  <?php endif ?>
  </div>
</div>
