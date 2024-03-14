<?php
require '../config/database.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
    $categoryID = filter_var($_POST['categoryID'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ingredients = filter_var($_POST['ingredients'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $instructions = filter_var($_POST['instructions'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $rImage = $_FILES['rImage'];

    // Validate form data
    if (!$categoryID) {
        $_SESSION['add-recipe'] = "Select food category";
    } elseif (!$title) {
        $_SESSION['add-recipe'] = "Enter the title";
    } elseif (!$description) {
        $_SESSION['add-recipe'] = "Enter the Description";
    } elseif (!$ingredients) {
        $_SESSION['add-recipe'] = "Enter the Ingredients";
    } elseif (!$instructions) {
        $_SESSION['add-recipe'] = "Enter the Instructions";
    } elseif (!$rImage['name']) {
        $_SESSION['add-recipe'] = "Choose post thumbnail";
    } else {
        //thumbnail
        $time = time();
        $rImage_name = $time . $rImage['name'];
        $rImage_tmp_name = $rImage['tmp_name'];
        $rImage_destination_path = '../../images/' . $rImage_name;

        // Make sure file is an image
        $allowed_extensions = ['png', 'jpg', 'jpeg'];
        $extension = strtolower(pathinfo($rImage_name, PATHINFO_EXTENSION)); // Get the file extension

        if (in_array($extension, $allowed_extensions)) {
            // Make sure image is not too big (less than 2MB)
            if ($rImage['size'] < 2000000) {
                move_uploaded_file($rImage_tmp_name, $rImage_destination_path);
            } else {
                $_SESSION['add-recipe'] = "File size is too big. Should be less than 2MB.";
            }
        } else {
            $_SESSION['add-recipe'] = "File should be in PNG, JPG, or JPEG format";
        }
    }

    if (isset($_SESSION['add-recipe'])) {
        $_SESSION['add-recipe-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/recipe/add-recipe.php');
        die();
    }

    // Insert recipe post into the database
    $query = "INSERT INTO `recipe` (`rImage`, `categoryID`, `title`, `rDescription`, `ingredients`, `instructions`) VALUES ('$rImage_name', '$categoryID', '$title', '$description', '$ingredients', '$instructions')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $_SESSION['add-recipe-success'] = "New post added successfully";
        header('location: ' . ROOT_URL . 'admin/');
        die();
    } else {
        $_SESSION['add-recipe'] = "Error: " . mysqli_error($connection);
        header('location: ' . ROOT_URL . 'admin/recipe/add-recipe.php');
        die();
    }
}

header('location: ' . ROOT_URL . 'admin/recipe/add-recipe.php');
die();
?>
