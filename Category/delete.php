<?php
require_once 'pdo.php';
require_once 'classes/Category.php';

$categoryObj = new Category($conn);

if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    $categoryObj->deleteCategory($categoryId);
    header('Location: index.php');
    exit();
} else {
    die('Category ID not provided');
}
?>
