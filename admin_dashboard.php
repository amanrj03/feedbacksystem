<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="max-w-6xl mx-auto bg-white p-8 rounded shadow">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Admin Dashboard</h2>
                <a href="logout.php" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Logout</a>
            </div>
            
            <div class="mb-4">
                <h3 class="text-xl font-semibold mb-4">All Feedbacks</h3>
                <div class="mb-4">
                    <button onclick="filterFeedbacks('all')" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">All</button>
                    <button onclick="filterFeedbacks('pending')" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600">Pending</button>
                    <button onclick="filterFeedbacks('resolved')" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Resolved</button>
                </div>
                <div id="feedbacksList"></div>
            </div>
        </div>
    </div>

    <script>
    function filterFeedbacks(status) {
        $.ajax({
            url: 'get_all_feedbacks.php',
            data: {status: status},
            success: function(data) {
                $('#feedbacksList').html(data);
            }
        });
    }

    function updateStatus(feedbackId, status) {
        $.ajax({
            url: 'update_status.php',
            method: 'POST',
            data: {feedback_id: feedbackId, status: status},
            success: function() {
                filterFeedbacks('all');
            }
        });
    }

    $(document).ready(function() {
        filterFeedbacks('all');
    });
    </script>
</body>
</html>