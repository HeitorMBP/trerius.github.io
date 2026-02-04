<?php
session_start();
unset ($_SESSION['login']);
unset ($_SESSION['senha']);
unset ($_SESSION['isAdmin']);
header('location:index.php');
?>