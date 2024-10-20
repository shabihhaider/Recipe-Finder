    <?php require('partials/head.php'); ?>
    <?php require('partials/nav.php'); ?>

    <main>
        <div class="container find-container">
            <h1 class="mt-5">Recipe <span>Search</span></h1>
            <p class="message"></p>
            <form id="recipeSearchForm">
                <div class="form-group mt-3">
                    <label for="ingredients">Enter Ingredients (comma-separated):</label>
                    <input type="text" id="ingredients" class="form-control mt-3" placeholder="e.g., chicken, tomato, garlic">
                </div>
                <button id="search-btn" type="submit" class="btn btn-primary mt-5">Search Recipes</button>
            </form>
            <div class="container">
                <section class="section__container special__container" id="special">
                    <div id="results" class="special__grid"></div>
                </section>
            </div>
            <div class="load">
                <button class="load-btn hidden" id="loadMore">Load More</button>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/find-recipe.js"></script>
    
    <script>
        let limitExceed = <?php echo $limitExceed ?>;
        let noOfSearches = <?php echo $user['no_of_searches'] ?>;
        const searchLimit = <?php echo $limit ?>;
        const userIsPaid = <?php echo $user['is_paid'] ?>;
    </script>

<?php require('partials/footer.php') ?>