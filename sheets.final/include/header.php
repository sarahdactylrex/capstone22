<?php
require_once 'functions.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blink Twice Photo LLC</title>
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <div class="my_bg_image"></div>

<header>
<?php if (isLoggedIn()): ?>
    <div class="header">
        Shopping Cart: <?=count($_SESSION['cart'])?> <a href="myCart.php"><img src="./include/images/cart.png" 
            style="width: 30px;"></a>
    </div>
<?php endif; ?>
</header>

<div class="sidenav">
    <?php if (isLoggedIn()): ?>
        <a href="index.php">Home</a>
        <a href="products.php">Shop</a>
        <a href="gallery.php">Gallery</a>
        <a href="myAccount.php">Account</a>
        <?php if (isAdmin()): ?>
            <a href="admintools.php">Admin</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
        </br></br>
        <a href="https://facebook.com/blinktwicephoto"><img src="./include/images/fb.png"
            style="height: 20px; margin-left: 20px;"></a>
        <a href="https://instagram.com/blinktwicephoto"><img src="./include/images/ig.png"
            style="height: 20px; margin-left: 20px;"></a>
         <a href="https://flickr.com/people/sevahhs/"><img src="./include/images/flickr.png"
            style="height: 20px; margin-left: 20px;"></a>
        <a href="https://stock.adobe.com/contributor/210084935/Sarah"><img src="./include/images/stock.jpg"
            style="height: 20px; margin-left: 20px;"></"></a>
        <a href="https://g.page/r/CYdOeo0U4EYSEBA"><img src="./include/images/goog.png"
            style="height: 20px; margin-left: 20px;"></a>
        </br>
        <?php else: ?>
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="login.php">Log In</a>
            <a href="newuser.php">Create Account</a>
            </br></br></br>
        <a href="https://facebook.com/blinktwicephoto"><img src="./include/images/fb.png"
            style="height: 20px; margin-left: 20px;"></a>
        <a href="https://instagram.com/blinktwicephoto"><img src="./include/images/ig.png"
            style="height: 20px; margin-left: 20px;"></a>
         <a href="https://flickr.com/people/sevahhs/"><img src="./include/images/flickr.png"
            style="height: 20px; margin-left: 20px;"></a>
        <a href="https://stock.adobe.com/contributor/210084935/Sarah"><img src="./include/images/stock.jpg"
            style="height: 20px; margin-left: 20px;"></"></a>
        <a href="https://g.page/r/CYdOeo0U4EYSEBA"><img src="./include/images/goog.png"
            style="height: 20px; margin-left: 20px;"></a>
        <?php endif; ?>
</div>

<p><?=displayMessage()?></p>