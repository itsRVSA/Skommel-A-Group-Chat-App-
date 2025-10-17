<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: chat.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Skommel - Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="glass-container">
        <h1>Welcome to Skommel 😁 </h1>
        <p>A simple group chat app created by RVS Aditya!</p>
        <div class="buttons">
            <a href="login.php" class="btn btn-primary">Login</a>
            <a href="register.php" class="btn btn-success">Register</a>
        </div>
    </div>

    <footer>
        CREATED BY <strong>RVS Aditya</strong>
    </footer>
</body>
</html>
