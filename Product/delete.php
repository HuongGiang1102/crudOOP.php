<?php
require_once 'pdo.php';
require_once 'classes/Product.php';

$productObj = new Product($conn);

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $productObj->deleteProduct($productId);
    header('Location: index.php');
    exit();
} else {
    die('Product ID not provided');
}
?>
