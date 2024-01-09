<?php
require_once 'include/header.php';
?>

<?php if (isLoggedIn()): ?>

<h3>Items in Basket:</h3>
<?php

if(!$_SESSION['cart']) {
   return null;
}

 foreach ($_SESSION['cart'] as $id)  {
            echo $id ."<p>";
        }
?>

<?php require_once 'include/footer.php' ?>
<?php endif; ?>