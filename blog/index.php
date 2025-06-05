<?php
include 'includes/db.php';
$stmt = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC");
$blogs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog System</title>
    <style>
        :root {
            --primary-color: #FFD700;
            --dark-color: #1a1a1a;
            --light-color: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: var(--dark-color);
            color: var(--light-color);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .main-header {
            background-color: #000;
            padding: 15px 0;
            border-bottom: 2px solid var(--primary-color);
        }

        .main-header h1 {
            color: var(--primary-color);
            font-size: 1.8rem;
        }

        .main-header nav a {
            color: var(--light-color);
            text-decoration: none;
            margin-left: 20px;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .blog-card {
            background-color: #2c2c2e;
            border-radius: 8px;
            padding: 15px;
            border: 1px solid var(--primary-color);
        }

        .blog-card h2 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .blog-card h2 a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 8px;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .blog-card p {
            font-size: 0.9rem;
            color: #ccc;
            margin-bottom: 10px;
        }

        .btn {
            background-color: var(--primary-color);
            color: #000;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .search-bar {
            margin: 20px 0;
            text-align: center;
        }

        #searchInput {
            width: 60%;
            padding: 10px;
            background-color: #333;
            border: 1px solid var(--primary-color);
            color: white;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .main-footer {
            background-color: #000;
            color: #aaa;
            padding: 15px;
            text-align: center;
            margin-top: 30px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="container">
            <h1 style="text-align:center; justify-content:center;">SatoshiCat Forum</h1>
            <nav>
                
            </nav>
        </div>
    </header>

    <div class="container">
        <h1 class="text-center" style="text-align:center; justify-content:center;">Welcome to Our SatoshiCat Blog - A Crypto Guide For Begininers </h1>

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search blogs..." onkeyup="searchBlogs()">
        </div>

        <div class="blog-grid" id="blogList">
            <?php if(empty($blogs)): ?>
                <p class="text-center">No blogs found. Check back later!</p>
            <?php else: ?>
                <?php foreach($blogs as $blog): ?>
                    <div class="blog-card">
                        <h2><a href="blog.php?id=<?= $blog['id'] ?>"><?= htmlspecialchars($blog['title']) ?></a></h2>
                        
                        <?php if(!empty($blog['video_url'])): ?>
                            <?php
                            // Extracting YouTube video ID
                            $video_url = $blog['video_url'];
                            preg_match('/(?:https?:\/\/(?:www\.)?youtube\.com\/(?:[^\/\n\s]*\/\S*\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video_url, $matches);
                            if (isset($matches[1])) {
                                $video_id = $matches[1];
                                $embed_url = "https://www.youtube.com/embed/$video_id";
                            } else {
                                $embed_url = ''; // Invalid URL or not a YouTube URL
                            }
                            ?>
                            <?php if (!empty($embed_url)): ?>
                                <div class="video-container">
                                    <iframe src="<?= $embed_url ?>" allowfullscreen></iframe>
                                </div>
                            <?php else: ?>
                                <p class="text-center">Invalid YouTube URL or video not available.</p>
                            <?php endif; ?>
                        <?php endif; ?>

                        <p><?= nl2br(htmlspecialchars(substr($blog['content'], 0, 150))) ?>...</p>
                        <a href="blog.php?id=<?= $blog['id'] ?>" class="btn">Read More</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <footer class="main-footer">
        <p>&copy; 2023 TechBlog. All rights reserved.</p>
    </footer>

    <script>
    function searchBlogs() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const blogCards = document.querySelectorAll('.blog-card');
        
        blogCards.forEach(card => {
            const title = card.querySelector('h2').textContent.toLowerCase();
            const content = card.querySelector('p').textContent.toLowerCase();
            card.style.display = (title.includes(input) || content.includes(input)) ? 'block' : 'none';
        });
    }
    </script>
</body>
</html>
