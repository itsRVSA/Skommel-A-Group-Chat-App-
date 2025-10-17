<?php
session_start();
if(!isset($_SESSION['user_id'])) exit;

$conn = new mysqli("localhost","root","","skommel");
if($conn->connect_error) die("Connection failed");

if(isset($_POST['message'])){
    $message = trim($_POST['message']);
    $stmt = $conn->prepare("INSERT INTO messages (sender_id,message) VALUES (?,?)");
    $stmt->bind_param("is", $_SESSION['user_id'], $message);
    $stmt->execute();
    $stmt->close();
}
