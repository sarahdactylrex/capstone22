<?php
require_once 'include/header.php';
$message = handleSubmit();
$products = getProducts();
addToCart();
?>

<h3>Currently Available</h3>

<?php if (isLoggedIn()): ?>
    <p>
    <?php else: ?>
        Please sign in or create an account for pricing or purchase.
<?php endif; ?>

<?php if (!empty($message)): ?>
    <p><?=$message?></p>
<?php endif; ?>

<table>
    <tr>
        <th>Image</th>
        <th>Print Size</th>
        <th>Finish</th>
        <?php if(isLoggedIn()): ?>
        <th>Price</th>
        <?php endif; ?>
    </tr>
<?php foreach($products as $product): ?>
    <tr>
        <td><?=$product['image_name']?></a></td>
        <td><?=$product['print_size']?></td>
        <td><?=$product['finish']?></td>
        <?php if (isLoggedIn()): ?>
        <td><?=$product['price']?></td>
        <td>
            <?=addRemoveLink($product['id'])?>
        </td>
        <?php endif; ?>
    </tr>
<?php endforeach; ?>
</table>

<?php if(isLoggedIn()): ?>
<p><div class="custom_order_link">
<h3>Not what you're looking for? We do <a href="./custom-order.php">custom orders</a> as well!</h3>
</p></div>
<?php endif; ?>

<?php require_once 'include/footer.php' ?>