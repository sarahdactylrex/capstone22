<?php
require_once 'include/header.php';
$user = getUserInfoFromSession();
$users = getUsers();
editAcctSubmit();
?>

<?php if (!empty($message)): ?>
	<p><?=$message?></p>
<?php endif; ?>

<?php if (isLoggedIn()): ?>

<form action="" method="post" style="margin: 30px 0">
    <fieldset>
    <legend>Edit Personal Information:</legend>
    <input type="hidden" name="id" value="<?=$user?->id?>">

    <div>
        <label for="firstname">First Name:</label>
        <input type="text" name="first_name" id="first_name" value="<?=$user?->first_name?>">
    </div>
    <div>
        <label for="middlei">Middle Initial: (optional)</label>
        <input type="text" name="middle_init" id="middle_init" value="<?=$user?->middle_init?>">
    </div>
    <div>
        <label for="lastname">Last Name:</label>
        <input type="text" name="last_name" id="last_name" value="<?=$user?->last_name?>">
    </div>
    <div>
        <label for="email">Email Address:</label>
        <input type="text" name="email" id="email" value="<?=$user?->email?>">
    </div>
    <div>
        <label for="phone">Phone Number: (optional)</label>
        <input type="text" name="phone" id="phone" value="<?=$user?->phone?>">
    </div>
    <div>
        <button type="submit">Save</button>
        <button onclick="window.location='myAccount.php'; return false">Cancel</button>
    </div>
    </fieldset>
</form>

<p><a href="custom-order.php">Custom Print Requests</a></p>
<p><a href="address.php">Manage Address Book</a><p>
<p><a href="changepw.php">Change My Password</a></p>

    <?php foreach($users as $user): ?>
    <?php endforeach; ?>

<table>
    <tr>
        <th>First Name: </th>
        <th><?=$user['first_name']?></th>
    </tr>
    <tr>
        <th>Middle I: </th>
        <th><?=$user['middle_init']?></th>
    </tr>
    <tr>
        <th>Last Name: </th>
        <th><?=$user['last_name']?></th>
    </tr>
    <tr>
        <th>Email: </th>
        <th><?=$user['email']?></th>
    </tr>
    <tr>
        <th>Phone: </th>
        <th><?=$user['middle_init']?></th>
    </tr>
</table>

<?php require_once 'include/footer.php' ?>
<?php endif; ?>