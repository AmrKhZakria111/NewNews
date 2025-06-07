<?php
include 'db.php';

if (isset($_GET['id'])) {
    $articleID = $_GET['id'];

    // Fetch the article from the database
    $query = "SELECT * FROM article WHERE ArticleID = :articleID";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':articleID', $articleID);
    $stmt->execute();
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$article) {
        // Redirect if article not found
        header("Location: manage_news.php");
        exit();
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        $status = $_POST['status'];

        // Update the article in the database
        $updateQuery = "UPDATE article SET Title = :title, Content = :content, CategoryID = :category, Status = :status WHERE ArticleID = :articleID";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bindParam(':title', $title);
        $updateStmt->bindParam(':content', $content);
        $updateStmt->bindParam(':category', $category);
        $updateStmt->bindParam(':status', $status);
        $updateStmt->bindParam(':articleID', $articleID);
        $updateStmt->execute();

        // Redirect back to the manage news page
        header("Location: manage_news.php");
        exit();
    }
} else {
    // Redirect if no article ID is specified
    header("Location: manage_news.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Article</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $article['Title'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required><?= $article['Content'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="1" <?= $article['CategoryID'] == 1 ? 'selected' : '' ?>>Sport</option>
                    <option value="2" <?= $article['CategoryID'] == 2 ? 'selected' : '' ?>>Business</option>
                    <option value="3" <?= $article['CategoryID'] == 3 ? 'selected' : '' ?>>Technology</option>
                    <option value="4" <?= $article['CategoryID'] == 4 ? 'selected' : '' ?>>Earth</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= $article['Status'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Article</button>
        </form>
    </div>
</body>
</html>
