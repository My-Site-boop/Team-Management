<?php
session_start();
include("../config/db.php");

// ❌ Block non-admin
if ($_SESSION['user']['role'] != 'admin') {
    echo "Access Denied";
    exit;
}

// ✅ Check if data exists
if (
    isset($_POST['title']) &&
    isset($_POST['assigned_to']) &&
    isset($_POST['project_id']) &&
    isset($_POST['due_date'])
) {

    $title = $_POST['title'];
    $assigned = $_POST['assigned_to'];
    $project = $_POST['project_id'];
    $due = $_POST['due_date'];

    // ✅ Validate empty
    if ($assigned == "" || $project == "") {
        echo "Please select user and project";
        exit;
    }

    $sql = "INSERT INTO tasks (title, assigned_to, project_id, due_date)
            VALUES ('$title','$assigned','$project','$due')";

    if ($conn->query($sql)) {
        echo "Task Added";
    } else {
        echo "DB Error: " . $conn->error;
    }

} else {
    echo "Missing data";
}


if (isset($_POST['id']) && isset($_POST['status'])) {

    $task_id = $_POST['id'];
    $status = $_POST['status'];

    $user_id = $_SESSION['user']['id'];
    $role = $_SESSION['user']['role'];

    // Get task
    $res = $conn->query("SELECT assigned_to FROM tasks WHERE id=$task_id");
    $task = $res->fetch_assoc();

    if (!$task) {
        echo "Task not found";
        exit;
    }

    // 🔐 Permission check
    if ($role != 'admin' && $task['assigned_to'] != $user_id) {
        echo "Access Denied";
        exit;
    }

    // ✅ Update
    if ($conn->query("UPDATE tasks SET status='$status' WHERE id=$task_id")) {
        echo "updated";
    } else {
        echo "error";
    }

    exit;
}
?>