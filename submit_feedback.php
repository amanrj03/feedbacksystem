<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) die("Unauthorized");

$stmt = $conn->prepare("INSERT INTO feedback (user_id, message) VALUES (?, ?)");
$stmt->bind_param("is", $_SESSION['user_id'], $_POST['message']);
$stmt->execute();
$stmt->close();
$conn->close();
?>