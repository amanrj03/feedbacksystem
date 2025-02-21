<?php
session_start();
require 'config.php';

if ($_SESSION['role'] !== 'admin') die("Unauthorized");

$stmt = $conn->prepare("UPDATE feedback SET status = ? WHERE id = ?");
$stmt->bind_param("si", $_POST['status'], $_POST['feedback_id']);
$stmt->execute();
$stmt->close();
$conn->close();
?>