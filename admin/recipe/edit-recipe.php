<?php
include '../partials/Header.php';
session_start();

// Fetch categories from the database
$category_query = "SELECT * FROM category";
$categories = mysqli_query($connection, $category_query);

// Fetch recipe data based on the recipeID from the URL
$recipe = null; // Initialize $recipe variable
if (isset($_GET['recipeID'])) {
    $recipeID = filter_var($_GET['recipeID'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM recipe WHERE recipeID=$recipeID";
    $result = mysqli_query($connection, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $recipe = mysqli_fetch_assoc($result);
    } else {
        echo "Recipe not found or does not exist.";
        exit;
    }
} else {
    header('location: ' . ROOT_URL . 'admin/');
    die();
}
?>

<section class="form_section">
  <div class="container form_section-container">
    <h2>Edit recipe</h2>
    <form method="POST" action="<?= ROOT_URL ?>admin/recipe/edit-recipe-logic.php" enctype="multipart/form-data">
      <input type="hidden" name="recipeID" value="<?= $recipe['recipeID'] ?>">
      <input type="hidden" name="previous_thumbnail_name" value="<?= $recipe['rImage'] ?>">
      <select name="categoryID">
        <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
          <option value="<?= $category['categoryID'] ?>"<?= ($category['categoryID'] == $recipe['categoryID']) ? ' selected' : '' ?>>
            <?= $category['recipeType'] ?>
          </option>
        <?php endwhile ?>
      </select>
      <input type="text" name="title" value="<?= isset($recipe['title']) ? $recipe['title'] : '' ?>" placeholder="Title">
      <textarea rows="4" name="rDescription" placeholder="Description"><?= isset($recipe['rDescription']) ? $recipe['rDescription'] : '' ?></textarea>
      <textarea rows="4" name="ingredients" placeholder="Ingredients"><?= isset($recipe['ingredients']) ? $recipe['ingredients'] : '' ?></textarea>
      <textarea rows="4" name="instructions" placeholder="Instructions"><?= isset($recipe['instructions']) ? $recipe['instructions'] : '' ?></textarea>
   
        <div class="form_control">
        <label for="rImage">recipe Image</label>
        <input type="file" name="rImage" id="rImage">
      </div>
      <button type="submit" name="submit" class="btn">Update recipe</button>
    </form>
  </div>
</section>

<?php
include '../../partials/footer.php';
?>
