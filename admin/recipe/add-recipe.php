<?php
  include '../partials/Header.php';
  session_start();

  // Fetch categories from database
  $query = "SELECT * FROM category";
  $categories = mysqli_query($connection, $query);

  // Get back form data if invalid post
  $title = $_SESSION['add-recipe-data']['title'] ?? '';

  // Delete data from session
  unset($_SESSION['add-recipe-data']);
?>

<body>
  <section class="form_section">
    <div class="container form_section-container">
      <h2>Add Recipe</h2> 
      <?php if (isset($_SESSION['add-recipe'])) : ?>
        <div class="alert_message error">
          <p><?= $_SESSION['add-recipe']; ?></p>
          <?php unset($_SESSION['add-recipe']); ?>
        </div>  
      <?php endif ?>
      <form action="<?= ROOT_URL ?>admin/recipe/add-recipe-logic.php" enctype="multipart/form-data" method="POST">
        <select name="categoryID"> <!-- Update the name to CategoryID -->
          <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
            <option value="<?= $category['categoryID'] ?>"><?= $category['recipeType'] ?></option>
          <?php endwhile ?>
        </select>
        <input type="text" name="title" value="<?= $title ?>" placeholder="Title" required>
        <textarea rows="4" name="description" placeholder="Description"></textarea>  
        <textarea rows="4" name="ingredients" placeholder="Ingredients"></textarea>  
        <textarea rows="4" name="instructions" placeholder="Instructions"></textarea>  
        <div class="form_control">
          <label for="foodimg">Recipe Image</label>
          <input type="file" name="rImage" id="rImage">
        </div>
        <button type="submit" name="submit" class="btn">Add Recipe</button>
      </form>
    </div>
  </section>

  <!-- <?php include '../../partials/footer.php'; ?> -->
</body>
