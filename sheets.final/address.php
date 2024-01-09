<?php
require_once 'include/header.php';
$addresses = getAddresses();
$address = getUserAddressToEdit();
newAddressSubmit();
?>

<?php if (!empty($message)): ?>
	<p><?=$message?></p>
<?php endif; ?>

<?php if (isLoggedIn()): ?>

<form action="" method="post" style="margin: 30px 0">
    <fieldset>
    <legend>Address Book</legend>
    <input type="hidden" name="id" value="<?=$address?->id?>">
    <div>
        <label for="address1">Address Line 1:</label>
        <input type="text" name="address1" id="address1" value="<?=$address?->address_line1?>">
    </div>
    <div>
        <label for="address2">Address Line 2:</label>
        <input type="text" name="address2" id="address2" value="<?=$address?->address_line2?>">
    </div>
    <div>
        <label for="city">City:</label>
        <input type="text" name="city" id="city" value="<?=$address?->city?>">
    </div>
    <div>
        <label for="state">State:</label>
        <input type="text" name="state" id="state" value="<?=$address?->state?>">
    </div>
    <div>
        <label for="zip">Zip Code:</label>
        <input type="text" name="zip" id="zip" value="<?=$address?->zip?>">
    </div>
    <div>
        <button type="submit">Save</button>
        <button onclick="window.location='address.php'; return false">Cancel</button>

    </div>
    </fieldset>
</form>

<table>
    <tr>
        <th>Address Line 1</th>
        <th>Address Line 2</th>
        <th>City</th>
        <th>State</th>
        <th>Zip </th>
        <th>Modify</th>
    </tr>
    <?php foreach($addresses as $address): ?>
    <tr>
        <td><?=$address['address_line1']?></td>
        <td><?=$address['address_line2']?></td>
        <td><?=$address['city']?></td>
        <td><?=$address['state']?></td>
        <td><?=$address['zip']?></td>
        <td>
            <a href="address.php?id=<?=$address['id']?>">Edit</a>
        |
            <a href="delete-address.php?id=<?=$address['id']?>"
                onclick="confirm('Are you sure?')">  Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>


<?php require_once 'include/footer.php' ?>
<?php endif; ?>