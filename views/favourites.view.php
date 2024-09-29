<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favourites</title>
    <!--BOOTSTRAP CSS CDN LINK-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/favourites.css">
</head>
<body>
    <?php require('partials/head.php'); ?>
    <?php require('partials/nav.php'); ?>
    <?php require('partials/banner.php'); ?>

    <main>
      <h1 class="mt-5 ms-5">Favourites</h1>
        <div class="container">
          <?php if(!isset($user['is_paid'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>You are not a paid user. </strong>To save Favourite Recipes. Please take our subscription.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>
            <?php foreach($savedRecipes as $recipe) : ?>
            <div id="results" class="mt-5">
              <div class="card text-bg-success ms-5 mt-5" style="width: 18rem;">
                <img src="<?= $recipe['recipe_image'] ?>" class="card-img-top" alt="<?= $recipe['recipe_title'] ?>">
                  <div class="card-body">
                    <h5 class="card-title"><?= $recipe['recipe_title'] ?></h5>
                    <p><a href="https://spoonacular.com/recipes/<?= $recipe['recipe_title'] ?>-<?= $recipe['recipe_id'] ?>" target="_blank" class="btn btn-primary">View Recipe</a></p>
                    <!--<button class="btn btn-success" id="save-recipe" data-id="<?= $recipe['recipe_id'] ?>" data-title="<?= $recipe['recipe_title'] ?>" data-image="<?= $recipe['recipe_image'] ?>" ">Save</button>-->
                  </div>
              </div>
           </div>
           <?php endforeach; ?>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--BOOTSTRAP JS CDN LINK-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>