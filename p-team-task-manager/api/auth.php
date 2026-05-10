<?php
session_start();
include("../config/db.php");

$action = $_GET['action'] ?? '';

if ($action == "register") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name,email,password,role) 
            VALUES ('$name','$email','$pass','$role')";
    
    if ($conn->query($sql)) {
        echo "Registered";
    } else {
        echo "Error";
    }
    exit;
}

if ($action == "login") {

    $email = trim($_POST['email']);
    $pass = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email'");

    if ($res && $res->num_rows > 0) {
        $user = $res->fetch_assoc();

        if (password_verify($pass, $user['password'])) {
            $_SESSION['user'] = $user;
            echo "success";
        } else {
            echo "wrong_password";
        }
    } else {
        echo "no_user";
    }
    exit;
}


if (!isset($_SESSION['user'])) {
    header("Location: /p-team-task-manager/public/login.php");
    exit();
}
?>