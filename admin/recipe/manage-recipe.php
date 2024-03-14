<?php
include '../partials/Header.php';
session_start();

// Include your database connection code here if not already included
// ...

// Fetch recipe data from the database
$recipe_query = "SELECT r.*, c.recipeType
                  FROM recipe r
                  LEFT JOIN category c ON r.categoryID = c.categoryID";
$recipes = mysqli_query($connection, $recipe_query);
?>

<section class="dashboard">
  <div class="container dashboard_container">
    <button id="show_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
    <button id="hide_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
    <aside>
    <ul>
      <li>
          <a href="../recipe/add-recipe.php"><i class="uil uil-list-ul"></i>
            <h5>Add Recipe</h5>
          </a>
        </li>
        <li>
          <a href="../recipe/manage-recipe.php"><i class="uil uil-list-ul"></i>
            <h5>Manage Recipe</h5>
          </a>
        </li>
        <li>
          <a href="../category/add-category.php"><i class="uil uil-list-ul"></i>
            <h5>Add Category</h5>
          </a>
        </li>
        <li>
          <a href="../category/manage-categories.php"><i class="uil uil-edit"></i>
            <h5>Manage Category</h5>
          </a>
        </li>
      </ul>
    </aside>
    <main>
       <h2>Manage recipe</h2>
       <table>
          <thead>
            <tr>

              <th>Title</th>
              <th>Description</th>
              <th>Ingredients</th>
              <th>Instructions</th>
              <th>Category</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($recipe = mysqli_fetch_assoc($recipes)) : ?>
            <tr>
              <td><?= $recipe['title'] ?></td>
              <td><?= $recipe['rDescription'] ?></td>
              <td><?= $recipe['ingredients'] ?></td>
              <td><?= $recipe['instructions'] ?></td>
              <td><?= $recipe['recipeType'] ?></td>
                 
              <td><a href="edit-recipe.php?recipeID=<?= $recipe['recipeID'] ?>" class="btn sm">Edit</a></td>
              <td><a href="delete-recipe.php?recipeID=<?= $recipe['recipeID'] ?>" class="btn sm danger">Delete</a></td>
            </tr>
            <?php endwhile ?>
          </tbody>
       </table>
    </main>
  </div>
</section>

<?php
  include '../../partials/footer.php';
?>
