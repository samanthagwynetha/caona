<?php
include 'partials/header.php';

// Fetch all categories
$all_categories_query = "SELECT * FROM category";
$all_categories = mysqli_query($connection, $all_categories_query); 
?>

<section class="category_buttons">
  <div class="container category_buttons-container">
    <?php while ($category = mysqli_fetch_assoc($all_categories)) : ?>
      <a href="<?= ROOT_URL ?>category-recipes.php?categoryID=<?= $category['categoryID'] ?>" class="category_button"><?= $category['recipeType']?></a>
    <?php endwhile ?>
  </div>
</section>

<?php include 'partials/footer.php'; ?>
