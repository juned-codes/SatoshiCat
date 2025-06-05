<?php
include 'includes/db.php';

$blog_id = $_GET['id'];

// Fetch comments for the blog post
$stmt = $pdo->prepare("SELECT * FROM comments WHERE blog_id = ? ORDER BY created_at DESC");
$stmt->execute([$blog_id]);
$comments = $stmt->fetchAll();

if (empty($comments)) {
    echo '<p>No comments yet. Be the first to comment!</p>';
} else {
    foreach ($comments as $comment) {
        echo '
        <div class="comment">
            <strong>' . htmlspecialchars($comment['username']) . '</strong>
            <p>' . htmlspecialchars($comment['comment']) . '</p>
            <small>' . date('M j, Y, h:i a', strtotime($comment['created_at'])) . '</small>
        </div>';
    }
}
?>