<?php
include 'db.php';

$query = "SELECT article.ArticleID, article.Title, category.Name AS Category, user.Username AS Author, article.PublishedAt 
          FROM article
          JOIN category ON article.CategoryID = category.CategoryID
          JOIN user ON article.AuthorID = user.UserID";
$stmt = $conn->prepare($query);
$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>📰 Manage News</h1>
        <a href="add_news.php" class="btn btn-success mb-3">Add News</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?= $article['ArticleID'] ?></td>
                    <td><?= $article['Title'] ?></td>
                    <td><?= $article['Category'] ?></td>
                    <td><?= $article['Author'] ?></td>
                    <td><?= $article['PublishedAt'] ?></td>
                    <td>
                        <a href="edit_news.php?id=<?= $article['ArticleID'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_news.php?id=<?= $article['ArticleID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
