<?php
require '../config/database.php';

    // Check and validate input values
    if (isset($_POST['submit'])) {
        $recipeID = filter_var($_POST['recipeID'], FILTER_SANITIZE_NUMBER_INT);
        $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $categoryID = filter_var($_POST['categoryID'], FILTER_SANITIZE_NUMBER_INT);
        $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
        $rDescription = filter_var($_POST['rDescription'], FILTER_SANITIZE_SPECIAL_CHARS);
        $ingredients = filter_var($_POST['ingredients'], FILTER_SANITIZE_SPECIAL_CHARS);
        $instructions = filter_var($_POST['instructions'], FILTER_SANITIZE_SPECIAL_CHARS);
        $thumbnail = $_FILES['rImage'];
    
        // Check and validate input values
        if (!$categoryID || !$title || !$rDescription || !$ingredients || !$instructions) {
            $_SESSION['edit-recipe'] = "Couldn't Update";
        } else {
         // Delete existing thumbnail if available
         if ($thumbnail['name']) {
            $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
            if (file_exists($previous_thumbnail_path)) {
                unlink($previous_thumbnail_path);
            }

            // Work on the new thumbnail
            // Rename the image
            $time = time(); // Make each image name unique
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/' . $thumbnail_name;

            // Make sure the file is an image
            $allowed_extensions = ['png', 'jpg', 'jpeg'];
            $extension = strtolower(pathinfo($thumbnail_name, PATHINFO_EXTENSION)); // Get the file extension

            if (in_array($extension, $allowed_extensions)) {
                // Make sure the thumbnail is not too large (less than 2MB)
                if ($thumbnail['size'] < 2000000) {
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                } else {
                    $_SESSION['edit-vehicle-post'] = "File size is too big. Should be less than 2MB.";
                }
            } else {
                $_SESSION['edit-vehicle-post'] = "File should be in PNG, JPG, or JPEG format";
            }
         }
    
            if (!isset($_SESSION['edit-recipe'])) {
                // Update recipe data in the database
                $query = "UPDATE recipe SET rImage='$thumbnail_to_insert', categoryID=$categoryID, title='$title', rDescription='$rDescription', ingredients='$ingredients', instructions='$instructions' WHERE recipeID=$recipeID";
                $result = mysqli_query($connection, $query);
    
                if ($result) {
                    $_SESSION['edit-recipe-success'] = "Post updated successfully";
                } else {
                    $_SESSION['edit-recipe'] = "Error updating post: " . mysqli_error($connection);
                }
            }
        }

    if ($_SESSION['edit-recipe']) {
        // Redirect to the edit page if the form was invalid
        header('location: ' . ROOT_URL . 'admin/recipe/edit-recipe.php?recipeID=' . $recipeID);
        die();
    } else {
        // Set the thumbnail or keep the existing one
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

        $query = "UPDATE recipe SET rImage='$thumbnail_to_insert', categoryID='$categoryID', title='$title', rDescription='$rDescription', ingredients='$ingredients', instructions='$instructions' WHERE recipeID=$recipeID LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-recipe-success'] = "Post updated successfully";
        }

        // Redirect to the edit page or another appropriate location
        header('location: ' . ROOT_URL . 'admin/recipe/edit-recipe.php?recipeID=' . $recipeID);
        die();
    }
}

// If the form was not submitted, you can display the edit form here
?>
