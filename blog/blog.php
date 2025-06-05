<?php
include 'includes/db.php';
$id = $_GET['id'];

// Function to extract YouTube ID from different URL formats
function extractYouTubeID($url) {
    $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
    preg_match($pattern, $url, $matches);
    return isset($matches[1]) ? $matches[1] : null;
}

$stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->execute([$id]);
$blog = $stmt->fetch();

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $comment = htmlspecialchars($_POST['comment']);

    if (!empty($username) && !empty($comment)) {
        $stmt = $pdo->prepare("INSERT INTO comments (blog_id, username, comment) VALUES (?, ?, ?)");
        $stmt->execute([$id, $username, $comment]);
    }
}

// Get comments
$stmt = $pdo->prepare("SELECT * FROM comments WHERE blog_id = ? ORDER BY created_at DESC");
$stmt->execute([$id]);
$comments = $stmt->fetchAll();
?>



<style>
    body {
        background-color: #2c2c2e;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #1a1a1a;
        color: white;
        border-radius: 10px;
    }

    .blog-card {
        background-color: #2c2c2e;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #FFD700;
    }

    .video-container {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
        border-radius: 8px;
        background-color: #000;
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    .video-error {
        color: #ff5555;
        text-align: center;
        padding: 20px;
    }

    .comment-section {
        margin-top: 30px;
    }

    .comment-form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .comment-form input,
    .comment-form textarea {
        padding: 10px;
        border: 1px solid #FFD700;
        border-radius: 5px;
        background-color: #333;
        color: white;
    }

    .comment-form button {
        background-color: #FFD700;
        color: black;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    .comment {
        background-color: #2c2c2e;
        padding: 10px;
        margin-top: 10px;
        border-radius: 5px;
    }

    .comment strong {
        color: #FFD700;
    }

    .comment small {
        display: block;
        color: #ccc;
        margin-top: 5px;
    }
</style>

<div class="container">
    <div class="blog-card">
        <h2><?= htmlspecialchars($blog['title']) ?></h2>
        <?php if (!empty($blog['video_url'])): ?>
            <div class="video-container">
                <?php
                $video_id = extractYouTubeID($blog['video_url']);
                if ($video_id) {
                    $embed_url = "https://www.youtube.com/embed/$video_id";
                    echo '<iframe src="' . $embed_url . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                } else {
                    echo '<div class="video-error">Invalid YouTube URL. Please check the link and try again.</div>';
                }
                ?>
            </div>
        <?php endif; ?>
        <p><?= nl2br(htmlspecialchars($blog['content'])) ?></p>
    </div>

    <div class="comment-section">
        <h3>Comments (<?= count($comments) ?>)</h3>
        <form class="comment-form" method="POST">
            <input type="text" name="username" placeholder="Your Name" required>
            <textarea name="comment" placeholder="Your Comment" required></textarea>
            <button type="submit" class="btn">Post Comment</button>
        </form>

        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <strong><?= htmlspecialchars($comment['username']) ?></strong>
                <p><?= htmlspecialchars($comment['comment']) ?></p>
                <small><?= date('M j, Y', strtotime($comment['created_at'])) ?></small>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>