<?php
require '../config/database.php';

if (isset($_POST['submit'])){
  $categoryID = filter_var($_POST['categoryID'], FILTER_SANITIZE_NUMBER_INT);
  $recipeType = filter_var($_POST['recipeType'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $rDescription = filter_var($_POST['rDescription'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  //validate input
  if(!$recipeType || !$rDescription){
    $_SESSION['edit-category'] = "Invalid form input on edit category";
  } else {
    $query = "UPDATE category SET recipeType='$recipeType', rDescription='$rDescription' WHERE categoryID=$categoryID LIMIT 1";
    $result = mysqli_query($connection, $query);

    if(mysqli_errno($connection)) {
      $_SESSION['edit-category'] = "Couldn't update category";
    } else {
      $_SESSION['edit-category-success'] = "Category $recipeType updated successful";
    }
  }
}
header('location: ' . ROOT_URL . 'admin/category/manage-categories.php');
die();
?>