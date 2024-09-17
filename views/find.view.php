<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/find-recipe.css">
</head>
<body>
  
<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <!-- Your content -->
      <div class="container">
        <h1 class="mt-5">Recipe Search</h1>
        <form id="recipeSearchForm">
            <div class="form-group mt-3">
                <label for="ingredients">Enter Ingredients (comma-separated):</label>
                <input type="text" id="ingredients" class="form-control mt-3" placeholder="e.g., chicken, tomato, garlic">
            </div>
            <button id="search-btn" type="submit" class="btn btn-primary mt-5">Search Recipes</button>
        </form>
        <div id="results" class="mt-5"></div>
        <!-- Load More button, hidden by default -->
        <div class="load">
          <button class ="load-btn hidden" id="loadMore">Load More</button>
        </div>
    </div>
  </main>
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/find-recipe.js"></script>
</body>
</html>
