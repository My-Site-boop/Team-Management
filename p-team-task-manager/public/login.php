<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <form id="loginForm">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="button" onclick="loginUser()">Login</button>
    </form>

    <p>No account? <a href="register.php">Register</a></p>
</div>

<script src="/p-team-task-manager/assets/js/script.js"></script>

</body>
</html>