<?php
require_once 'pdo.php';
require_once 'classes/Category.php';

$categoryObj = new Category($conn);

if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    $category = $categoryObj->getCategory($categoryId);
    if (!$category) {
        die('Category not found');
    }
} else {
    die('Category ID not provided');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    if (empty($name)) {
        $error = 'Please enter a category name.';
        header('Location: edit.php?id=' . $categoryId . '&error=' . urlencode($error));
        exit();
    }

    $categoryObj->updateCategory($categoryId, $name);

    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Category</title>
</head>
<body>
    <div class="container">
        <h1>Edit Category</h1>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?= $_GET['error'] ?>
            </div>
        <?php endif; ?>
        <form action="edit.php?id=<?= $categoryId ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $category['name'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
