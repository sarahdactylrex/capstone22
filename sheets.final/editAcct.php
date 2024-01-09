<?php
require_once 'include/header.php';
$user = getUserInfo();
$users = getUsers();
editAcctSubmit();
?>

<?php if (!empty($message)): ?>
	<p><?=$message?></p>
<?php endif; ?>

<?php if (isLoggedIn()): ?>
<?php if (isAdmin()): ?>
    
<h3>Admin Editor</h3>
<h4>Proceed with caution, records are overwritten.</h4>

<form action="" method="post" style="margin: 30px 0">
    <fieldset>
    <legend>Account Information:</legend>
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
        <button onclick="window.location='editAcct.php'; return false">Cancel</button>
    </div>
    </fieldset>
</form>

<table>
    <tr>
        <th>Record ID</th>
        <th>First Name</th>
        <th>Middle I</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
    </tr>
    <?php foreach($users as $user): ?>
    <tr>
        <td><?=$user['id']?></td>
        <td><?=$user['first_name']?></td>
        <td><?=$user['middle_init']?></td>
        <td><?=$user['last_name']?></td>
        <td><?=$user['email']?></td>
        <td><?=$user['phone']?></td>
        <td>
            <a href="editAcct.php?id=<?=$user['id']?>">Edit</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php require_once 'include/footer.php' ?>
<?php endif; ?>
<?php endif; ?>