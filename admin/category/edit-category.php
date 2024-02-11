<?php
  include '../partials/Header.php';
  session_start();
if(!isset($_SESSION['admin_ID'])){
  header('location: '. ROOT_URL .'admin/login.php');
}

  if(isset($_GET['categoryID'])){
    $categoryID = filter_var($_GET['categoryID'], FILTER_SANITIZE_NUMBER_INT);
    // fetch category from db
    $query = "SELECT * FROM category WHERE categoryID=$categoryID";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) == 1){
      $category = mysqli_fetch_assoc($result);
    }
  } else {
    header('location: ' . ROOT_URL . 'admin/manage-categories');
    die();
  }
?>

<section class="form_section">
  <div class="container form_section-container">
    <h2>Edit Category</h2>
    <form action="<?= ROOT_URL?>admin/category/edit-category-logic.php" method="POST">
      <input type="hidden" name="categoryID" value="<?= $category['categoryID'] ?>">
      <input type="text" name="recipeType" value="<?= $category['recipeType'] ?>" placeholder="Type of recipe">
      <textarea rows="4" name="rDescription" placeholder="Description"><?= $category['rDescription']?> </textarea>
      <button type="submit" name="submit" class="btn">Update</button>
    </form>
  </div>
</section>

<?php
  include '../../partials/footer.php';
?>