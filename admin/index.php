<?php
include 'partials/Header.php';
session_start();
if(!isset($_SESSION['admin_ID'])){
  header('location: '. ROOT_URL .'admin/login.php');
}

// Include your database connection code here if not already included
// ...

// Fetch vehicle data from the database
$recipe_query = "SELECT r.*, c.recipeType AS FoodCategory
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
          <a href="add-recipe-post.php"><i class="uil uil-list-ul"></i>
            <h5>Add Recipe</h5>
          </a>
        </li>
        <li>
          <a href="manage-recipe-post.php"><i class="uil uil-pen"></i>
            <h5>Manage Recipe</h5>
          </a>
        </li>
        <li>
          <a href="category/add-category.php"><i class="uil uil-list-ul"></i>
            <h5>Add Category</h5>
          </a>
        </li>
        <li>
          <a href="category/manage-categories.php"><i class="uil uil-edit"></i>
            <h5>Manage Category</h5>
          </a>
        </li>

        <li>
          <a href="customer-info.php"><i class="uil uil-user-plus"></i>
            <h5>Contributer Info</h5>
          </a>
        </li>
      </ul>
    </aside>
    <div class="table">
    <main>
       <h2>Manage Vehicle</h2>
       <table>
          <thead>
            <tr>
              <th>Brand</th>
              <th>Model</th>
              <th>Plate No.</th>
              <th>RPD</th>
              <th>Category</th>
              <th>Status</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($recipe = mysqli_fetch_assoc($recipes)) : ?>
            <tr>
              <td><?= $recipe['vBrand'] ?></td>
              <td><?= $recipe['vModel'] ?></td>
              <td><?= $recipe['vPLNo'] ?></td>
              <td><?= $recipe['RatePerDay'] ?></td>
              <td><?= $recipe['recipeType'] ?></td>
              <td><?= $recipe['Availability'] ?></td>
              <!--<td>
                <select name="status_<?= $recipe['recipeID'] ?>">
                  <option value="available" <?= ($recipe['Availability'] == '1') ? 'selected' : '' ?>>Available</option>
                  <option value="unavailable" <?= ($recipe['Availability'] == '0') ? 'selected' : '' ?>>Unavailable</option>
                </select>
              </td>-->
              
              <td><a href="edit-recipe.php?recipeID=<?= $recipe['recipeID'] ?>" class="btn sm">Edit</a></td>
              <td><a href="delete-recipe.php?recipeID=<?= $recipe['recipeID'] ?>" class="btn sm danger">Delete</a></td>
            </tr>
            <?php endwhile ?>
          </tbody>
       </table>
    </main>
    </div>
  </div>
</section>

<?php
  include '../partials/footer.php';
?>
