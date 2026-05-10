<?php
include("../config/db.php");
session_start();

if ($_SESSION['user']['role'] != 'admin') {
    echo "Access Denied";
    exit;
}

$name = $_POST['name'];
$user_id = $_SESSION['user']['id'];

$sql = "INSERT INTO projects (name, created_by) VALUES ('$name','$user_id')";

if ($conn->query($sql)) {
    echo "Project Created";
}
?>