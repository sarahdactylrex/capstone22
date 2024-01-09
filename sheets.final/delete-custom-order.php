<?php
require_once 'include/functions.php';

$id = $_GET['id'] ?? 0;

deleteCustomOrder($id);

header('Location: custom-order.php');