<?php
  include '../partials/Header.php';
  session_start();
if(!isset($_SESSION['admin_ID'])){
  header('location: '. ROOT_URL .'admin/login.php');
}

  //fetch categories from database
  $query = "SELECT * FROM category ORDER BY recipeType DESC";
  $categories = mysqli_query($connection, $query);
?>

<section class="dashboard">
  
<?php if (isset($_SESSION['add-category-success'])) : ?> //shows if add category was successful
  <div class="alert_message success">
    <p>
      <?= $_SESSION['add-category-success'];
      unset($_SESSION['add-category-success']);
      ?>
    </p>
  </div>
<?php elseif (isset($_SESSION['add-category'])) : ?> //shows if add category was not successful
  <div class="alert_message error container">
    <p>
      <?= $_SESSION['add-category'];
      unset($_SESSION['add-category']);
      ?>
    </p>
  </div>
  <?php elseif (isset($_SESSION['edit-category'])) : ?> //shows if edit category was not successful
  <div class="alert_message error container">
    <p>
      <?= $_SESSION['edit-category'];
      unset($_SESSION['edit-category']);
      ?>
    </p>
  </div>
  <?php elseif (isset($_SESSION['edit-category-success'])) : ?> //shows if edit category was not successful
  <div class="alert_message error container">
    <p>
      <?= $_SESSION['edit-category-success'];
      unset($_SESSION['edit-category-success']);
      ?>
    </p>
  </div>
  <?php elseif (isset($_SESSION['delete-category-success'])) : ?> //shows if delete category was successful
  <div class="alert_message error container">
    <p>
      <?= $_SESSION['delete-category-success'];
      unset($_SESSION['delete-category-success']);
      ?>
    </p>
  </div>

  <?php endif ?>
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
          <a href="add-category.php"><i class="uil uil-list-ul"></i>
            <h5>Add Category</h5>
          </a>
        </li>
        <li>
          <a href="manage-categories.php"><i class="uil uil-edit"></i>
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
    
    <main>
       <h2>Manage Categories</h2>
       <?php if(mysqli_num_rows($categories) > 0) : ?>
       <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Description</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
            <tr>
              <td><?= $category['recipeType']?></td>
              <td><?= $category['rDescription']?></td>
              <td> <a href="<?= ROOT_URL?>admin/category/edit-category.php?categoryID=<?= $category['categoryID']?>" class="btn sm">Edit</a>
               </td>
             
               <td> <a href="<?= ROOT_URL?>admin/category/delete-category.php?categoryID=<?= $category['categoryID']?>" class="btn sm danger">Delete</a>
               </td>
             
            </tr>
            <?php endwhile  ?>
          </tbody>
       </table>
       <?php else : ?>
        <div class="alert_message error"><?= "No categories found"?></div>
        <?php endif ?>
    </main>
  </div>
</section>
 
<?php
  include '../../partials/footer.php';
  ?>