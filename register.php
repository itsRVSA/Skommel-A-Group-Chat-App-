<?php
session_start();
$conn = new mysqli("localhost","root","","skommel");
if($conn->connect_error) die("Connection failed");

$error = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = trim($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check if username exists
    $check = $conn->prepare("SELECT id FROM users WHERE username=?");
    $check->bind_param("s",$username);
    $check->execute();
    $check->store_result();
    if($check->num_rows > 0){
        $error = "Username already taken";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username,password) VALUES (?,?)");
        $stmt->bind_param("ss",$username,$password);
        $stmt->execute();
        $stmt->close();
        header("Location: login.php");
        exit;
    }
    $check->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Skommel - Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="glass-container">
        <h1>Register</h1>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Register">
        </form>
        <?php if($error) echo "<p class='error'>$error</p>"; ?>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <footer>
        CREATED BY <strong>RVS Aditya</strong>
    </footer>
</body>
</html>
