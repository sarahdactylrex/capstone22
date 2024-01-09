<?php
require_once 'include/header.php';
$message = handleSubmit();
$products = getProducts();
$product = getProductToEdit();
?>

<?php if (isAdmin()): ?>
    
<h3>Edit Inventory</h3>

<?php if (!empty($message)): ?>
    <p><?=$message?></p>
<?php endif; ?>

<?php if (isLoggedIn()): ?>
<form action="" method="post" enctype="multipart/form-data">
<fieldset>
<legend>Product Details</legend>
<input type="hidden" name="id" value="<?=$product?->id?>">
    <div>
    <label for="name">Image Name:</label>
    <input type="text" name="image_name" id="image_name" value="<?=$product?->image_name?>">
    </div>
    <div>
    <label for="name">Print Size:</label>
    <input type="text" name="print_size" id="print_size" value="<?=$product?->print_size?>">
    </div>
    <div>
    <label for="name">Finish:</label>
    <input type="text" name="finish" id="finish" value="<?=$product?->finish?>">
    </div>
    <div>
    <label for="name">Price:</label>
    <input type="text" name="price" id="price" value="<?=$product?->price?>">
    </div>
    <div>
    <label for="preview">Image:</label>
    <input type="file" name="image" id="image">
    </div>
    <button type="submit">Save</button>
    <button onclick="window.location='admin-inventory.php'; return false">Cancel</button>
</form>
</fieldset>
<?php endif; ?>

<table>
    <tr>
        <th>ID</th>
        <th>Image Name</th>
        <th>Preview</th>
        <th>Print Size</th>
        <th>Finish</th>
        <th>Price</th>
        <th>Modify</th>
    </tr>
<?php foreach($products as $product): ?>
    <tr>
        <td><?=$product['id']?></td>
        <td><?=$product['image_name']?></td>
        <td>
            <?php if(isset($product['image_id'])): ?>
                <img src="get-image.php?id=<?=$product['image_id']?>" alt="preview" height="100">
            <?php endif; ?>
        </td>
        <td><?=$product['print_size']?></td>
        <td><?=$product['finish']?></td>
        <td><?=$product['price']?></td>
            <td>
            <a href="admin-inventory.php?id=<?=$product['id']?>">Edit </a>||
            <a href="delete-product.php?id=<?=$product['id']?>"
                onclick="confirm('Delete record?')">Delete</a>
            </td>
    </tr>
<?php endforeach; ?>
</table>

<?php require_once 'include/footer.php' ?>
<?php endif; ?>