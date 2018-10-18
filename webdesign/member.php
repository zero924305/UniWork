<?php
$page_title = "NeRV|Profile";
include_once 'partials/headers.php';
include_once 'partials/parseMember.php';

echo "<pre>";
var_dump($members);
echo "</pre>";
?>

<section class="container">
<section class="jumbotron">
        <h2>NeRV Member</h2>
        <hr/>
        <?php if(count($members)>0): ?>
          <?php foreach ($members as $members): ?>
            <div class="row col-lg-3" style="margin-bottm:10px;">

            </div>
          <?php endforeach;?>
        <?php else:?>
        <p>
          No member found
        </p>
      <?php endif;?>
</section>
</section>
<?php include_once 'partials/footer.php'; ?>
