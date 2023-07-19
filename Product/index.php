<?php
require_once 'pdo.php';
require_once 'classes/Product.php';
require_once 'classes/Category.php';

$productObj = new Product($conn);
$categoryObj = new Category($conn);

$products = $productObj->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Product List</title>
</head>
<body>
    <div class="container">
        <h1>Products</h1>
        <a href="create.php" class="btn btn-primary">Create</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $categoryObj->getCategory($product['category_id'])['name'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="delete.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
