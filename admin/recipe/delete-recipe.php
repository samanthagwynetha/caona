<?php
require  '../config/database.php';

if(isset($_GET['recipeID'])) {
  $recipeID = filter_var($_GET['recipeID'], FILTER_SANITIZE_NUMBER_INT);

  //FOR LATER
  //update recipe_id of posts that belong to this recipe to id of uncategorieds hdaihoadissoai
  
  //DELETE recipe
  $query = "DELETE FROM recipe WHERE recipeID=$recipeID LIMIT 1";
  $result = mysqli_query($connection, $query);
  $_SESSION['delete-recipe-success'] = "recipe deleted successfully";
}
header('location: ' . ROOT_URL . 'admin/recipe/manage-recipe.php');
?>