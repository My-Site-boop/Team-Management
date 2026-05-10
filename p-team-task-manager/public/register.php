<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <h2>Register</h2>

    <form id="registerForm">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <select name="role">
            <option value="member">Member</option>
            <option value="admin">Admin</option>
        </select>

        <button type="button" onclick="registerUser()">Register</button>
    </form>

    <p>Already have account? <a href="login.php">Login</a></p>
</div>

<script src="/p-team-task-manager/assets/js/script.js"></script>

</body>
</html>