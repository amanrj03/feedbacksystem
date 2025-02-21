<?php
session_start();
require 'config.php';

if ($_SESSION['role'] !== 'admin') die("Unauthorized");

$status = $_GET['status'] ?? 'all';
$sql = "SELECT feedback.*, users.username FROM feedback JOIN users ON feedback.user_id = users.id";
if ($status !== 'all') $sql .= " WHERE status = '$status'";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $statusColor = $row['status'] === 'resolved' ? 'bg-green-200' : 'bg-yellow-200';
    echo '<div class="mb-4 p-4 rounded '.$statusColor.'">';
    echo '<p>'.nl2br(htmlspecialchars($row['message'])).'</p>';
    echo '<p class="text-sm text-gray-600 mt-2">';
    echo 'User: '.$row['username'].' | Date: '.$row['created_at'].' | Status: '.$row['status'];
    echo '</p>';
    echo '<button onclick="updateStatus('.$row['id'].', \'resolved\')" class="bg-green-500 text-white py-1 px-3 rounded hover:bg-green-600 mt-2">Resolve</button>';
    echo '<button onclick="updateStatus('.$row['id'].', \'pending\')" class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600 mt-2 ml-2">Pending</button>';
    echo '</div>';
}
?>