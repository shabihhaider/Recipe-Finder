    <?php require('partials/head.php'); ?>
    <?php require('partials/head.php'); ?>
    <?php require('partials/nav.php'); ?>

    <main>
      <div class="container">
      <section class="section__container special__container" id="special">
        <h2 class="section__header">My Recipes</h2>
        <div class="special__grid">
          <?php foreach($savedRecipes as $recipe) : ?>
            <div class="special__card">
              <img src="<?= $recipe['recipe_image'] ?>" alt="<?= $recipe['recipe_title'] ?>" />
              <h4><?= $recipe['recipe_title'] ?></h4>
              <p>
                Diced chicken simmered in aromatic curry sauce with mixed veggies
                like potatoes, cauliflower, and beans for a hearty, flavorful dish.
              </p>
              <div class="special__ratings">
                <span><i class="ri-star-fill"></i></span>
                <span><i class="ri-star-fill"></i></span>
                <span><i class="ri-star-fill"></i></span>
                <span><i class="ri-star-fill"></i></span>
                <span><i class="ri-star-fill"></i></span>
              </div>
              <div class="special__footer">
                <button class="btn"><a href="https://spoonacular.com/recipes/<?= $recipe['recipe_title'] ?>-<?= $recipe['recipe_id'] ?>" target="_blank" class="btn btn-primary">View Recipe</a></button>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </section>
      </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--BOOTSTRAP JS CDN LINK-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php require('partials/footer.php') ?>