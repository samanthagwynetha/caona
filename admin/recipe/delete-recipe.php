<?php
require '../config/database.php';

if(isset($_GET['recipeID'])) {
    $recipeID = filter_var($_GET['recipeID'], FILTER_SANITIZE_NUMBER_INT);

    // Update recipe_id of posts that belong to this recipe to id of uncategorieds
    // $update_query = "UPDATE recipe SET recipeID = NULL WHERE recipeID = $recipeID";
    // $update_result = mysqli_query($connection, $update_query);

    $query = "SELECT * FROM recipe WHERE recipeID=$recipeID";
    $result = mysqli_query($connection, $query);

    // Delete recipe
    $delete_query = "DELETE FROM recipe WHERE recipeID = $recipeID LIMIT 1";
    $delete_result = mysqli_query($connection, $delete_query);

    if ($delete_result) {
        $_SESSION['delete-recipe-success'] = "Recipe deleted successfully";
    } else {
        $_SESSION['delete-recipe-error'] = "Failed to delete recipe";
    }
}

header('location: ' . ROOT_URL . 'admin/recipe/manage-recipe.php');
?>