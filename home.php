<?php
session_start();

if(isset($_SESSION['adminID'])){
  include '../partials/aheader.php'; // Include admin header if an admin is logged in
} else {
  include 'partials/HomeHeader.php'; // Include regular header for non-admin users
}

// Fetch recipes
$query = "SELECT * FROM recipe ORDER BY recipeID DESC";
$recipes = mysqli_query($connection, $query);
?>

<!--===========================HOME==================================-->

<section class="home" id="home">
  <div class="home-text">
    <h1>  
      <span>Discover</span> new <span>recipes</span> <br> and <span>delicacies</span></h1>
    <p>Welcome to our recipe collection, where you can explore a wide range of delicious dishes from various cuisines. From appetizers to desserts, find inspiration for your next culinary adventure and delight your taste buds!</p>

    <button class="home-btn">
      <a class="home-discover" href="#home-recipes">Start Exploring</a>
    </button>
  </div>
  
  <div class="food-image-container">
    <img class="food-image" src="images/food-image.png">
  </div>
</section>


<!--===========================ABOUT==================================-->
<section class="home-about" id="home-about">
  <div class="about-img">
    <img src="images/about-img.jpg" alt="">
  </div>

  <div class="about-text">
    <h2>Explore Culinary Delights</h2>
    <p>Discover the art of cooking with our collection of recipes curated for food enthusiasts like you. From traditional favorites to contemporary creations, our recipes cater to every palate and occasion.</p>
  </div>
</section>



<!--===========================RECIPES==================================-->
<section class="home-services" id="home-recipes">
  <p class="top-text">BEST RECIPES</p>
  <h2 class="top-text sersec">Explore Recipes</h2>

  <div class="container posts_container">
  <?php while ($recipe = mysqli_fetch_assoc($recipes)) : ?>
    <?php
    // Fetch the category details for the current recipe
    $category_query = "SELECT * FROM category WHERE categoryID = " . $recipe['categoryID'];
    $category_result = mysqli_query($connection, $category_query);
    $category = mysqli_fetch_assoc($category_result);
    ?>
    <article class="post">
        <div class="post_thumbnail">
            <img class="thumbnail_img" src="./images/<?= $recipe['rImage'] ?>">
        </div>
        <div class="post_info">
        <h3 class="post_title"><a href="recipe-details.php?recipeID=<?= $recipe['recipeID'] ?>"><?= $recipe['title'] ?></a></h3>
            <a href="<?= ROOT_URL ?>category-posts.php?CategoryID=<?= $recipe['categoryID']?>" class="category_button"><?= $category['recipeType']?></a>
           
        </div>
    </article>
<?php endwhile ?>

  </div>
</section>

<!--=======================CONTACT====================-->
<section class="home-contact" id="home-contact">
  <h2>GET IN TOUCH</h2>

  <div class="contact-info">
    <div class="info-item">
      <img src="" alt="">
      <h2>Location</h2>
      <p>Your Address, City, Country</p>
    </div>

    <div class="info-item">
      <img src="" alt="">
      <h2>Phone</h2>
      <p>+1234567890</p>
    </div>

    <div class="info-item">
      <img src="" alt="">
      <h2>Email</h2>
      <p>your.email@example.com</p>
    </div>
  </div>

  <div class="contact-container">
    <form>
        <input type="text" name="Name" placeholder="Full Name" required>
        <input type="email" name="Email" placeholder="Email" required>
        <textarea name="Message" placeholder="Message" required></textarea>
        <button type="submit" class="btn">Send</button>
    </form>
  </div>
</section>

<!--=======================CATEGORY BUTTON====================-->
<section class="category_buttons">
    <div class="container category_buttons-container">
        <?php
        $all_categories_query = "SELECT * FROM category";
        $all_categories = mysqli_query($connection, $all_categories_query); 
        ?>
        <?php while ($category = mysqli_fetch_assoc($all_categories)) : ?>
            <a href="<?= ROOT_URL ?>category-posts.php?CategoryID=<?= $category['categoryID'] ?>" 
                class="category_button"><?= $category['recipeType'] ?>
            </a>
        <?php endwhile ?>
    </div>
</section>

<!--=======================END OF THE CATEGORY BUTTON====================-->

<?php include 'partials/footer.php'; ?>
