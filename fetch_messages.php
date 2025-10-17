<?php
session_start();
if(!isset($_SESSION['user_id'])) exit;

$conn = new mysqli("localhost","root","","skommel");
if($conn->connect_error) die("Connection failed");

$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT m.*, u.username FROM messages m JOIN users u ON m.sender_id=u.id ORDER BY m.created_at ASC");

while($row = $result->fetch_assoc()){
    $class = ($row['sender_id'] == $user_id) ? "sent" : "received";
    echo "<div class='message $class'>";
    echo "<strong>{$row['username']}:</strong> {$row['message']}";
    echo "<span class='timestamp'>{$row['created_at']}</span>";
    echo "</div>";
}
