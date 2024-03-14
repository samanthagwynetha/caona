<?php
require '../config/database.php';

if (isset($_GET['categoryID'])) {
    $categoryID = filter_var($_GET['categoryID'], FILTER_SANITIZE_NUMBER_INT);

    // Delete associated recipes first
    $delete_recipes_query = "DELETE FROM recipe WHERE categoryID = $categoryID";
    $delete_recipes_result = mysqli_query($connection, $delete_recipes_query);

    // Delete category
    $delete_category_query = "DELETE FROM category WHERE categoryID = $categoryID LIMIT 1";
    $delete_category_result = mysqli_query($connection, $delete_category_query);

    if ($delete_category_result) {
        $_SESSION['delete-category-success'] = "Category deleted successfully";
    } else {
        $_SESSION['delete-category-error'] = "Failed to delete category";
    }
}

header('location: ' . ROOT_URL . 'admin/category/manage-categories.php');

?>