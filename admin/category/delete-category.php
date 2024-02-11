<?php
require  '../config/database.php';

if(isset($_GET['categoryID'])) {
  $categoryID = filter_var($_GET['categoryID'], FILTER_SANITIZE_NUMBER_INT);

  //FOR LATER
  //update category_id of posts that belong to this category to id of uncategorieds hdaihoadissoai
  
  //DELETE CATEGORY
  $query = "DELETE FROM category WHERE categoryID=$categoryID LIMIT 1";
  $result = mysqli_query($connection, $query);
  $_SESSION['delete-category-success'] = "Category deleted successfully";
}
header('location: ' . ROOT_URL . 'admin/category/manage-categories.php');
?>