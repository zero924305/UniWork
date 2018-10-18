<?php
 include_once 'Resource/session.php';
 include_once 'Resource/database.php';
 include_once 'Resource/utilities.php';
?>
<?php
//mysql connection
mysql_connect('localhost','student18','indigo65') or die("could not connect");
mysql_select_db('student18') or die ("could not fine database");

$output='';
//collect
 if(isset($_POST['search']))
 {
   $searchq = $_POST['search'];
   $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);


   $sqlQuery = mysql_query("SELECT * FROM product WHERE product_name LIKE '%$searchq%'") or die("could not search!");
   $count = mysql_num_rows($sqlQuery);

   if($count == 0)
   {
      $output = 'There was no search results!';
   }
   else
   {
      while($row=mysql_fetch_array($sqlQuery))
      {
        $name = $row['product_name'];
        $image = $row['product_image'];
        $price = $row['product_price'];
        $quantity = $row['product_quantity'];
        $id = $row['product_id'];

        $output .= '<article class="col-md-4">
                    <h3>'.$name.'</h3>
                    <hr/>
                    <img src="'.$image.'"class="" height="100%" width="100%"/>
                    <br/>

                    </br/>
                    <p><a class="btn btn-lg btn-primary" role="button" disabled="disabled">More Info &raquo;</a></p>
                    </article>';
      }
   }

 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php if(isset($page_title)) echo $page_title ?> </title>
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="57x57" href="icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="icon/favicon-16x16.png">
    <link rel="manifest" href="image/icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="design/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="design/style.css">

    <script src="design/bootstrap/js/jquery.min.js"></script>
    <script src="design/bootstrap/js/jquery-migrate.min.js"></script>
    <script src="design/bootstrap/js/bootstrap.min.js"></script>
</head>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <section class="container-fluid">
      <section class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="imagepadding" href="admin.php"><img src="image/icon.png"></a>
        <a class="navbar-brand" href="admin.php">NeRV</a>
      </section>
      <section id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <?php if((!isset($_SESSION['user_id']))): ?>
              <li><a href="signup.php" class="nav-text">Signup</a></li>
              <li><a href="login.php" class="nav-text">Login</a></li>
            <?php else: ?>
              <li><a href="logout.php" class="nav-text" >Logout</a></li>
              <?php echo '<li><a href="profile.php" class="nav-text">'."Welcome! ".$_SESSION['username'].'</a></li>'?>
              <li><a href="upload.php" class="nav-text">Upload</a></li>
            <?php endif ?>
            <li><a href="contact.php" class="nav-text">Contact</a></li>
            <li><a href="index.php" class="nav-text">Home</a></li>
            <li>
              <form class="navbar-form" role="search" method="post" action="search.php">
              <section class="input-group">
                <input type="text"
                name="search" class="form-control" placeholder="Search for product...">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-default" value="">
                  <span class="glyphicon glyphicon-search">
                    <span class="sr-only"></span>
                  </span>
                </button>
              </span>
              </section>
            </form>
            </li>
          </ul>
        </section>
    </section>
</nav>
<body id="body">
