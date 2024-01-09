<?php
require_once 'include/header.php';
?>

<?php if (!empty($message)): ?>
	<p><?=$message?></p>
<?php endif; ?>

<?php if (isLoggedIn()): ?>

<form action="changepwSubmit.php" method="post" style="margin: 30px 0">
    <fieldset>
    <legend>Change My Password</legend>
    <div>
        <label for="password">New Password:</label>
        <input type="password" name="new_pass" id="new_pass">
    </div>
    <div>
        <label for="password">Verify New Password:</label>
        <input type="password" name="verify" id="verify">
    </div>
    <div>
        <button type="submit">Update</button>
    </div>
    </fieldset>
</form>

<?php require_once 'include/footer.php' ?>
<?php endif; ?>
