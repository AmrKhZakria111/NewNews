<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $authorID = $_POST['author'];
    $categoryID = $_POST['category'];
    $publishedAt = date('Y-m-d H:i:s');

    $query = "INSERT INTO article (Title, Content, AuthorID, CategoryID, PublishedAt, Status) 
              VALUES (:title, :content, :author, :category, :publishedAt, 'Published')";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ':title' => $title,
        ':content' => $content,
        ':author' => $authorID,
        ':category' => $categoryID,
        ':publishedAt' => $publishedAt
    ]);

    header('Location: manage_news.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Add News</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <?php
                    $categories = $conn->query("SELECT * FROM category")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($categories as $category) {
                        echo "<option value='{$category['CategoryID']}'>{$category['Name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <select class="form-control" id="author" name="author" required>
                    <?php
                    $authors = $conn->query("SELECT * FROM user WHERE RoleID = 1")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($authors as $author) {
                        echo "<option value='{$author['UserID']}'>{$author['Username']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add News</button>
        </form>
    </div>
</body>
</html>
