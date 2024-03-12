<?php
include 'partials/header.php';

// Check if recipeID is set
if (isset($_GET['recipeID'])) {
    $recipeID = filter_var($_GET['recipeID'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM recipe WHERE recipeID = $recipeID";
    $result = mysqli_query($connection, $query);

    // Fetch recipe details
    if ($recipe = mysqli_fetch_assoc($result)) {
?>
        <section class="recipe-details">
            <div class="container">
                <div class="recipe-details-content">
                    <div class="recipe-image">
                        <img src="images/<?= $recipe['rImage'] ?>" alt="<?= $recipe['title'] ?>">
                    </div>
                    <div class="recipe-info">
                        <h2><?= $recipe['title'] ?></h2>
                        <p class="recipe-description"><?= $recipe['rDescription'] ?></p>
                        <h3>Ingredients:</h3>
                        <p class="recipe-ingredients"><?= $recipe['ingredients'] ?></p>
                        <h3>Instructions:</h3>
                        <p class="recipe-instructions"><?= $recipe['instructions'] ?></p>
                    </div>
                </div>
            </div>
        </section>
<?php
    } else {
        echo "<p>Recipe not found.</p>";
    }
} else {
    echo "<p>Recipe ID not provided.</p>";
}

include 'partials/footer.php';
?>
