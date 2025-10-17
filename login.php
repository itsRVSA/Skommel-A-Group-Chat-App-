<?php
session_start();
$conn = new mysqli("localhost","root","","skommel");
if($conn->connect_error) die("Connection failed");

$error = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id,password FROM users WHERE username=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $stmt->bind_result($id,$hash);

    if($stmt->fetch()){
        if(password_verify($password,$hash)){
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: chat.php");
            exit;
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "User not found";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Skommel - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="glass-container">
        <h1>Login</h1>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <?php if($error) echo "<p class='error'>$error</p>"; ?>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>

    <footer>
        CREATED BY <strong>RVS Aditya</strong>
    </footer>
</body>
</html>
