<?php
include("../includes/auth_check.php");
include("../config/db.php");

$user = $_SESSION['user'];

// Fetch users & projects for dropdown
$users = $conn->query("SELECT id, name FROM users");
$projects = $conn->query("SELECT id, name FROM projects");
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/p-team-task-manager/assets/css/style.css">
</head>

<body class="bg-light">

<!-- 🔷 Navbar -->
<nav class="navbar navbar-dark bg-dark px-4 shadow">
    <span class="navbar-brand fw-bold">Task Manager</span>

    <div class="text-white d-flex align-items-center">
        <span class="me-3">Welcome, <?= $user['name'] ?></span>
        <a href="logout.php"><button class="btn btn-danger btn-sm">Logout</button></a>
    </div>
</nav>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="bg-dark text-white p-3" style="width:250px; min-height:100vh;">
        <h4 class="mb-4">Task Manager</h4>

        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="#" class="nav-link text-white">📊 Dashboard</a>
            </li>
            <li class="nav-item mb-2">
                <a href="#" class="nav-link text-white">📁 Projects</a>
            </li>
            <li class="nav-item mb-2">
                <a href="#" class="nav-link text-white">✅ Tasks</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4">

    <!-- 🔷 Stats -->
    <div class="row mb-4">
        <?php
        $total = $conn->query("SELECT COUNT(*) as c FROM tasks")->fetch_assoc()['c'];
        $completed = $conn->query("SELECT COUNT(*) as c FROM tasks WHERE status='completed'")->fetch_assoc()['c'];
        $pending = $conn->query("SELECT COUNT(*) as c FROM tasks WHERE status='pending'")->fetch_assoc()['c'];
        ?>

        <div class="col-md-4">
            <div class="card shadow p-3 text-center">
                <h6>Total Tasks</h6>
                <h2><?= $total ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-3 text-center bg-success text-white">
                <h6>Completed</h6>
                <h2><?= $completed ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-3 text-center bg-warning">
                <h6>Pending</h6>
                <h2><?= $pending ?></h2>
            </div>
        </div>
    </div>

    <!-- 🔥 ADMIN ONLY FORMS -->
    <?php if ($user['role'] == 'admin'): ?>

    <div class="row mb-4">

        <!-- Create Project -->
        <div class="col-md-6">
            <div class="card shadow p-3">
                <h5>Create Project</h5>
                <form id="projectForm">
                    <input name="name" class="form-control mb-2" placeholder="Project Name" required>
                    <button type="button" onclick="createProject()" class="btn btn-success">Add Project</button>
                </form>
            </div>
        </div>

        <!-- Create Task -->
        <div class="col-md-6">
            <div class="card shadow p-3">
                <h5>Create Task</h5>
                <form id="taskForm">
                    <input name="title" class="form-control mb-2" placeholder="Task Title" required>

                    <select name="assigned_to" class="form-control mb-2" required>
                        <option value="">Select User</option>
                        <?php while($u = $users->fetch_assoc()): ?>
                            <option value="<?= $u['id'] ?>"><?= $u['name'] ?></option>
                        <?php endwhile; ?>
                    </select>

                    <select name="project_id" class="form-control mb-2" required>
                        <option value="">Select Project</option>
                        <?php while($p = $projects->fetch_assoc()): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['name'] ?></option>
                        <?php endwhile; ?>
                    </select>

                    <input type="date" name="due_date" class="form-control mb-2" required>

                    <button type="button" onclick="createTask()" class="btn btn-primary">Add Task</button>
                </form>
            </div>
        </div>

    </div>

    <?php else: ?>

    <div class="alert alert-info">
        Only admin can create projects and tasks.
    </div>

    <?php endif; ?>

    <!-- 🔷 TASK TABLE -->
    <div class="card shadow p-4">
        <h4>Tasks</h4>

        <table class="table table-hover">
            <tr>
                <th>Task</th>
                <th>Project</th>
                <th>User</th>
                <th>Status</th>
                <th>Due</th>
            </tr>

            <?php
            $tasks = $conn->query("
            SELECT tasks.*, users.name as user_name, projects.name as project_name
            FROM tasks
            LEFT JOIN users ON tasks.assigned_to = users.id
            LEFT JOIN projects ON tasks.project_id = projects.id
            ");

            while($row = $tasks->fetch_assoc()):
            ?>

            <tr>
                <td><?= $row['title'] ?></td>
                <td><?= $row['project_name'] ?></td>
                <td><?= $row['user_name'] ?></td>

                <td>
                <?php if ($user['role']=='admin' || $row['assigned_to']==$user['id']): ?>
                    <select onchange="updateStatus(<?= $row['id'] ?>, this)" class="form-select">
        <option value="pending" <?= $row['status']=='pending'?'selected':'' ?>>Pending</option>
        <option value="in_progress" <?= $row['status']=='in_progress'?'selected':'' ?>>In Progress</option>
        <option value="completed" <?= $row['status']=='completed'?'selected':'' ?>>Completed</option>
    </select>
                <?php else: ?>
                   <span class="badge bg-secondary"><?= $row['status'] ?></span>
                <?php endif; ?>
                </td>

                <td><?= $row['due_date'] ?></td>
            </tr>

            <?php endwhile; ?>
        </table>
    </div>

    </div>
</div>

<script src="/p-team-task-manager/assets/js/script.js"></script>

</body>
</html>