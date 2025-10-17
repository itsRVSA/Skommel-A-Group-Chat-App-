<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Skommel - Group Chat</title>
    <link rel="stylesheet" href="style.css">
    <script src="chat.js" defer></script>
</head>
<body>
    <div class="glass-container chat-container">
        <div id="chat-header">
            <span>Welcome, <?php echo $_SESSION['username']; ?></span>
            <a href="logout.php" class="btn btn-logout">Logout</a>
        </div>

        <div id="chat-box">
            <!-- Messages will be loaded here by AJAX -->
        </div>

        <form id="chat-form">
            <input type="text" id="message" placeholder="Type a message..." required>
            <input type="submit" value="Send">
        </form>
    </div>

    <footer>
        CREATED BY <strong>RVS Aditya</strong>
    </footer>
</body>
</html>
