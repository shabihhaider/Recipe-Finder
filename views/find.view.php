<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Search</title>
    <!--BOOTSTRAP CSS CDN LINK-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <script>
      let limitExceed = <?php echo isset($limitExceed) ? 'true' : 'false'; ?>;
      let noOfSearches = <?php echo isset($user['no_of_searches']) ? $user['no_of_searches'] : 0; ?>;
      const searchLimit = 5; // Free user limit

      console.log("Limit Exceeded: " + limitExceed);
      console.log("Number of Searches: " + noOfSearches);
    </script>

    <!--BOOTSTRAP JS CDN LINK-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    
</body>
</html>