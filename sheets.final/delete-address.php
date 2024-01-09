<?php
require_once 'include/functions.php';

$id = $_GET['id'] ?? 0;

deleteAddress($id);

header('Location: address.php');