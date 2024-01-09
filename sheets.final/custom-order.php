<?php
require_once 'include/header.php';
$products = getProducts();
$customorders = getAllCustOrders();
$customorder = getCustOrderToEdit();
?>


<?php if (!empty($message)): ?>
        <p><?=$message?></p>
<?php endif; ?>


<?php if (isLoggedIn()): ?>

<form action="custom-order-submit.php" method="post" style="margin: 30px 0">
<h3>Create your own print! Please make a selection for each constraint.</h3>
    <fieldset>
    <legend>Print Options</legend>
    <input type="hidden" name="id" value="<?=$customorder?->id?>">

    <div>
    <label for="cimage">Image:</label>
    <select name="cimage" id="cimage">
    <option value=""></option>
    <?php foreach ($products as $product): ?>
        <option value="<?=$product['image_name']?>"><?=$product['image_name']?></option>
    <?php endforeach; ?>
    </select>
    </div>

    <div>
    <label for="csize">Size:</label>
    <select name="csize" id="csize">
        <option value=""></option>
        <option value="5 x 7">5 x 7</option>
        <option value="8 x 10">8 x 10</option>
        <option value="11 x 14">11 x 14</option>
        <option value="16 x 20">16 x 20</option>
        <option value="20 x 30">20 x 30</option>
        <option value="24 x 36">24 x 36</option>
        <option value="30 x 40">30 x 40</option>
    </select>
    </div>

    <div>
    <label for="cfinish">Finish:</label>
    <select name="cfinish" id="cfinish">
        <option value=""></option>
        <option value="satin">satin</option>
        <option value="semi-gloss">semi-gloss</option>
        <option value="glossy">glossy</option>
        <option value="metallic">metallic</option>
        <option value="matte">matte</option>
    </select>
    </div>
  
        <button type="submit">Save</button>
        <button onclick="window.location='custom-order.php'; return false">Cancel</button>

    </div>
    </fieldset>
</form>

<table>
    <tr>
        <th>Photo</th>
        <th>Size</th>
        <th>Finish</th>
        <th>Request Date</th>
        <th>Cancel</th>
    </tr>
    <?php foreach($customorders as $customorder): ?>
    <tr>
        <td><?=$customorder['cimage']?></td>
        <td><?=$customorder['csize']?></td>
        <td><?=$customorder['cfinish']?></td>
        <td><?=$customorder['corder_date']?></td>
        <td>
            <a href="delete-custom-order.php?id=<?=$customorder['id']?>"
                onclick="confirm('Cancel this request?')">Remove</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php endif; ?>
<?php require_once 'include/footer.php' ?>