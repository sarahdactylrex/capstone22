<?php
require_once 'include/header.php';
?>
<?php if (isAdmin()): ?>
		<?php if (isLoggedIn()): ?>
            <a href="editAcct.php">Admin User Editor</a>
            <p>
            <a href="admin-inventory.php">Admin Inventory</a>
		<?php endif; ?>
<?php endif; ?>