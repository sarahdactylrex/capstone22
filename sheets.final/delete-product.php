<?php
require_once 'include/functions.php';

$id = $_GET['id'] ?? 0;

deleteProduct($id);

header('Location: admin-inventory.php');