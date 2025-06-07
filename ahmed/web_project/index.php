<?php
require 'db.php';

$sql = "SELECT ArticleID, Title, Image, PublishedAt FROM article WHERE Status = '' ORDER BY PublishedAt DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>News Portal</h1>
    <div class="news-container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="news-item">
                <img src="<?= $row['Image'] ?>" alt="News Image">
                <h2><?= $row['Title'] ?></h2>
                <p>Published at: <?= $row['PublishedAt'] ?></p>
                <a href="news.php?id=<?= $row['ArticleID'] ?>">Read More</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
