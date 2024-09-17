$(document).ready(function() {
    let ingredients = '';
    let offset = 0;
    let totalResults = 0; // Keep track of the total available recipes
    const apiKey = 'c13e725769804969a77e1670b5e70a7c';  // Replace with your Spoonacular API Key
    const recipesPerPage = 5;  // Number of recipes to load per request

    // Function to load recipes
    function loadRecipes() {
        const queryURL = `https://api.spoonacular.com/recipes/findByIngredients?ingredients=${ingredients}&number=${recipesPerPage}&offset=${offset}&apiKey=${apiKey}`;

        $.ajax({
            url: queryURL,
            method: 'GET',
            success: function(response, status, xhr) {
                // Update totalResults from the response headers if Spoonacular provides that, otherwise set a reasonable assumption
                const fetchedRecipes = response.length;

                // Append recipes if available
                if (fetchedRecipes > 0) {
                    response.forEach(function(recipe) {
                        $('#results').append(`
                            <div class="card text-bg-success ms-5 mt-5" style="width: 18rem;">
                                <img src="${recipe.image}" class="card-img-top" alt="${recipe.title}">
                                <div class="card-body">
                                    <h5 class="card-title">${recipe.title}</h5>
                                    <p><a href="https://spoonacular.com/recipes/${recipe.title}-${recipe.id}" target="_blank" class="btn btn-primary">View Recipe</a></p>
                                </div>
                            </div>
                        `);
                    });
                    // Increase the offset for the next request
                    offset += recipesPerPage;

                    // If the fetched number of recipes is less than requested, assume no more results
                    if (fetchedRecipes < recipesPerPage) {
                        $('#loadMore').hide();
                    } else {
                        $('#loadMore').show();  // Show load more if there are more recipes
                    }
                } else {
                    $('#loadMore').hide();
                    if (offset === 0) {
                        $('#results').append('<p>No recipes found.</p>'); // No results at all
                    }
                }
            },
            error: function() {
                $('#results').html('<p>Error retrieving recipes. Please try again.</p>');
            }
        });
    }

    // Initial recipe search
    $('#recipeSearchForm').on('submit', function(e) {
        e.preventDefault();
        ingredients = $('#ingredients').val().trim();  // Get ingredients input
        if (ingredients === "") {
            $('#results').html('<p>Please enter ingredients.</p>');
            return;
        }

        // Reset the results and offset for a new search
        $('#results').empty();
        offset = 0; // Reset the offset (offset means the number of recipes to skip)
        loadRecipes();  // Load the first set of recipes
    });

    // Load more button click event
    $('#loadMore').on('click', function() {
        loadRecipes();  // Load more recipes
    });
});