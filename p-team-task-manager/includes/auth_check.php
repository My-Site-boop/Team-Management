<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

function isAdmin() {
    return $_SESSION['user']['role'] == 'admin';
}
?>