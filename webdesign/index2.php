<?php
include_once 'config.php';
include_once 'function.php';
include_once 'partials/headers.php';

$page_title ='NeRV|Home';
$shop_name = _SHOP_NAME;

$op =isset($_REQUEST['op']) ? variable_filter($_REQUEST['op']."string"):'';
  switch($op)
  {
    case 'user_login':
    user_login();
    header("location:index2.php");
    exit;
    break;

    default:
    list_product();
    break;
  }
  function user_login()
    {
      global $admin_array;
      $user_name = variable_filter($_POST['user_name'], "string");
      if (in_array($user_name, $admin_array))
        {
           $user_name = $_SESSION['user_name'];
        }
    }

  function list_product()
  {
    $content='nothing';
  }

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

?>


    <div class="container">
      <div class="row">
        <div class="col-md-9 col-sm-8">main</div>
        <div class="col-md-3 col-sm-4">
          <div class="panel panel-primary">
            <div class="panel-heading">function</div>
            <div class="panel-body">
              <?php if (isset($user_name)):?>
                <div class="alert alert-success">
                  <?php echo $user_name."Hello, welcome to ".$shop_name?>
                </div>
                <a href="index2.php" class="btn btn-block btn-primary">Back to Home</a>
                <a href="#" class="btn btn-block btn-success">Insert product</a>
                <a href="logout.php" class="btn btn-block btn-success">Logout</a>
              <?php else:?>
                <form action="index2.php" method="post" role="form" class="form-horizontal">
                  <div class="form-group">
                    <label class="col-md-4 control-label">username：</label>
                    <div class="col-md-8">
                      <input type="text" name="user_name" value="" class="form-control" placeholder="insert">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-4"></label>
                    <div class="col-md-8">
                      <input type="hidden" name="op" value="user_login" >
                      <button type="submit" name="button" class="btn btn-primary btn-block">login</button>
                    </div>
                  </div>
                </form>
              <?php endif;?>
             </div>
          </div>
        </div>
      </div>
<?php include_once 'partials/footer.php' ?>
