<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Search</title>
    <!--BOOTSTRAP CSS CDN LINK-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/find-recipe.css">
</head>
<body>
    <?php require('partials/head.php'); ?>
    <?php require('partials/nav.php'); ?>
    <?php require('partials/banner.php'); ?>

    <main>
        <div class="container">
            <h1 class="mt-5">Recipe Search</h1>
            <p class="message"></p>
            <form id="recipeSearchForm">
                <div class="form-group mt-3">
                    <label for="ingredients">Enter Ingredients (comma-separated):</label>
                    <input type="text" id="ingredients" class="form-control mt-3" placeholder="e.g., chicken, tomato, garlic">
                </div>
                <button id="search-btn" type="submit" class="btn btn-primary mt-5">Search Recipes</button>
            </form>
            <div id="results" class="mt-5"></div>
            <div class="load">
                <button class="load-btn hidden" id="loadMore">Load More</button>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/find-recipe.js"></script>
    <!--BOOTSTRAP JS CDN LINK-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let limitExceed = <?php echo $limitExceed ?>;
        let noOfSearches = <?php echo $user['no_of_searches'] ?>;
        const searchLimit = <?php echo $limit ?>;
        const userIsPaid = <?php echo $user['is_paid'] ?>;
    </script>

</body>
</html>