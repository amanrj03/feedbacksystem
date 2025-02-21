<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) die("Unauthorized");

$stmt = $conn->prepare("SELECT * FROM feedback WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $statusColor = $row['status'] === 'resolved' ? 'bg-green-200' : 'bg-yellow-200';
    echo '<div class="mb-4 p-4 rounded '.$statusColor.'">';
    echo '<p>'.nl2br(htmlspecialchars($row['message'])).'</p>';
    echo '<p class="text-sm text-gray-600 mt-2">'.$row['created_at'].' - Status: '.$row['status'].'</p>';
    echo '</div>';
}
?>