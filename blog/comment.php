<?php
// Include database connection
include 'includes/db.php';

// Get the blog ID from the URL
$blog_id = $_GET['id'];

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $comment = htmlspecialchars($_POST['comment']);

    // Validate input
    if (!empty($username) && !empty($comment)) {
        try {
            // Insert comment into the database
            $stmt = $pdo->prepare("INSERT INTO comments (blog_id, username, comment) VALUES (?, ?, ?)");
            $stmt->execute([$blog_id, $username, $comment]);

            // Success message
            echo json_encode([
                'status' => 'success',
                'message' => 'Comment posted successfully!'
            ]);
            exit();
        } catch (Exception $e) {
            // Error message
            echo json_encode([
                'status' => 'error',
                'message' => 'Error posting comment: ' . $e->getMessage()
            ]);
            exit();
        }
    } else {
        // Validation error
        echo json_encode([
            'status' => 'error',
            'message' => 'Please fill in all fields.'
        ]);
        exit();
    }
}

// Fetch comments for the blog post
$stmt = $pdo->prepare("SELECT * FROM comments WHERE blog_id = ? ORDER BY created_at DESC");
$stmt->execute([$blog_id]);
$comments = $stmt->fetchAll();
?>

<!-- Comment Section -->
<div class="comment-section">
    <h3>Comments (<?= count($comments) ?>)</h3>

    <!-- Comment Form -->
    <form id="commentForm" class="comment-form">
        <input type="text" name="username" placeholder="Your Name" required>
        <textarea name="comment" placeholder="Your Comment" required></textarea>
        <button type="submit" class="btn">Post Comment</button>
    </form>

    <!-- Comments List -->
    <div id="commentsList">
        <?php if (empty($comments)): ?>
            <p>No comments yet. Be the first to comment!</p>
        <?php else: ?>
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <strong><?= htmlspecialchars($comment['username']) ?></strong>
                    <p><?= htmlspecialchars($comment['comment']) ?></p>
                    <small><?= date('M j, Y, h:i a', strtotime($comment['created_at'])) ?></small>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- JavaScript for Comment Submission -->
<script>
document.getElementById('commentForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);
    const blogId = <?= $blog_id ?>;

    try {
        const response = await fetch('comment.php?id=' + blogId, {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.status === 'success') {
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: result.message,
                timer: 2000,
                showConfirmButton: false
            });

            // Reload comments
            const commentsList = document.getElementById('commentsList');
            const response = await fetch('get_comments.php?id=' + blogId);
            commentsList.innerHTML = await response.text();
        } else {
            // Show error message
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: result.message
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'An unexpected error occurred'
        });
    }
});
</script>