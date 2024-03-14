<?php
include 'partials/header.php';

// Fetch recipes if CategoryID is set
if (isset($_GET['CategoryID'])) {
    $Category_ID = filter_var($_GET['CategoryID'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM recipe WHERE categoryID = $Category_ID";
    $recipes = mysqli_query($connection, $query);
} else {
    header('location: ' . ROOT_URL . 'home.php');
    die();
}
?>

<header class="category_title">
    <h2>
    <?php 
        // Fetch category from categories table
        $CategoryID = $Category_ID;
        $category_query = "SELECT * FROM category WHERE categoryID=$Category_ID";
        $category_result = mysqli_query($connection, $category_query);
        $category = mysqli_fetch_assoc($category_result); 
        echo $category['recipeType'];   
    ?>
    </h2>
    <span>
        <p>
        <?php 
            echo $category['rDescription'];   
        ?>
        </p>
    </span>
</header>

<section class="posts">
    <div class="container posts_container">
        <?php while ($recipe = mysqli_fetch_assoc($recipes)) : ?>
            <article class="post">
                <div class="post_thumbnail"
     
                >
                    <img class="thumbnail_img" src="./images/<?= $recipe['rImage'] ?>" 
                       
                    >
                </div>
                <div class="post_info">
                    <?php
                        echo '<h3 class="post_title"><a href="recipe-details.php?recipeID=' . $recipe['recipeID'] . '">' . 
                        $recipe['title'] . '</a></h3>';
                    ?>
                </div>
            </article>
        <?php endwhile ?>
    </div>
</section>

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

<?php
include 'partials/footer.php';
?>
