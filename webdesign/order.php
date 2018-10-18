<?php
include_once 'Resource/header.php';
?>
<div class="container">
      <?php if(!isset($_SESSION['username'])): ?>
        <?php   redirectTo('index');?>
      <?php else: ?>
          <?php flashMessage("Your order is completed","Pass")?>
      <?php endif?>
</div>
<?php
include_once 'Resource/footer.php';
?>
