<?php
require_once 'include/header.php';
$message = loginSubmit();
?>

<?php if (!empty($message)): ?>
	<p><?=$message?></p>
<?php endif; ?>

<form action="" method="post" style="margin: 30px 0">
    <fieldset>
    <legend>Log In</legend>
    <div>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <button type="submit">Log In</button>
    </div>
    </fieldset>
</form>

<?php require_once 'include/footer.php' ?>
