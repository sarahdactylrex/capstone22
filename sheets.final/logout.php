<?php
session_start();
$_SESSION = [];
$_SESSION['message'] = 'Come back soon!';
header('Location: login.php');
die();