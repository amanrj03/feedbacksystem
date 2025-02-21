<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Welcome, <?php echo $_SESSION['username']; ?></h2>
                <a href="logout.php" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Logout</a>
            </div>
            
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4">Submit Feedback</h3>
                <form id="feedbackForm">
                    <textarea name="message" required class="w-full px-3 py-2 border rounded mb-4" rows="4"></textarea>
                    <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Submit Feedback</button>
                </form>
            </div>
            
            <div>
                <h3 class="text-xl font-semibold mb-4">Previous Feedbacks</h3>
                <div id="feedbacksList"></div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        function loadFeedbacks() {
            $.ajax({
                url: 'get_feedbacks.php',
                success: function(data) {
                    $('#feedbacksList').html(data);
                }
            });
        }
        
        loadFeedbacks();
        
        $('#feedbackForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'submit_feedback.php',
                method: 'POST',
                data: $(this).serialize(),
                success: function() {
                    $('#feedbackForm textarea').val('');
                    loadFeedbacks();
                }
            });
        });
    });
    </script>
</body>
</html>