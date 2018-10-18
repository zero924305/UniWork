<?php
$page_title ="NeRV|New Home";
require_once 'config.php';
require_once 'partials/headers.php';
?>
<div class="container">
  <div id="head">
    <a href="index.php">
      <img src="image/title2.jpg" alt="" class="img-responsive" />
    </a>
  </div>
  <div id="main" class="row">
    <div class="col-md-9 col-sm-8">main</div>
    <div class="col-md-3 col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">Function</div>
        <div class="panel-body">
          <form action="" method="post" role="form" class="form-horizontal">
            <div class="form-group">
              <label class="col-md-4 control-label">username:</label>
              <div class="col-md-8">
                <input type="text" name="user_name" value="" class="form-control" placeholder="" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4"></label>
              <div class="col-md-8">
                <button type="submit" name="button" class="btn btn-primary btn-block">send</button>
              </div>
            </div>
          </form>
          <?php if(isset($_POST['user_name']))
          {
            echo "<div class='alert alert-success'>Hi {$_POST['user_name']}, welcome to "._NERV_NAME.".</div>";

          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once 'partials/footer.php'; ?>
