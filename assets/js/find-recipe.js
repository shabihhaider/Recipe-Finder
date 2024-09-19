let ingredients = '';
let offset = 0;
const apiKey = 'c13e725769804969a77e1670b5e70a7c';  // Replace with your Spoonacular API Key
const recipesPerPage = 5;  // Number of recipes to load per request
const queryURL = `https://api.spoonacular.com/recipes/findByIngredients?ingredients=${ingredients}&number=${recipesPerPage}&offset=${offset}&apiKey=${apiKey}`;
let searchCount = 0;

// Function to load recipes
function loadRecipes() {

    $.ajax({
        url: queryURL,
        method: 'GET',
        success: function(response) {
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
    console.log("load recipes");
}

// Function to disable/enable the search form
function limitIsExceed(isExceeded) {
    if (isExceeded) {
        $('#results').html(`
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Limit Exceeded!</strong> You have exceeded the limit of 5 searches per day.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            `);
        $('#recipeSearchForm :input').prop('disabled', true);
    } else {
        $('#recipeSearchForm :input').prop('disabled', false);
    }
}


$(document).ready(function() {

    // Initial check if limit is exceeded on page load
    if (limitExceed || noOfSearches >= searchLimit) {
        limitIsExceed(true);
    }

    // Form submit handler
    $('#recipeSearchForm').on('submit', function(e) {
        e.preventDefault();
        if ($('#recipeSearchForm :input').prop('disabled')) {
            return; // Prevent form submission if the form is disabled
        }

        ingredients = $('#ingredients').val().trim();  // Get ingredients input
        if (ingredients === "") {
            $('#results').html('<p>Please enter ingredients.</p>');
            return;
        }

        // Send the search request to the server
        $.ajax({
            url: '/find',
            method: 'POST',
            data: { search: ingredients },
            success: function(response) {
                const data = JSON.parse(response);

                if (data.limitExceed) {
                    limitIsExceed(true);
                } else {
                    noOfSearches = data.searchCount;
                    loadRecipes();  // Load the recipes after a successful search
                }
            },
            error: function() {
                console.log('Error saving search');
            }
        });

        // Load more button click event
        $('#loadMore').on('click', function() {
            if ($('#recipeSearchForm :input').prop('disabled')) {
                return; // Prevent loading more if the form is disabled
            }
            loadRecipes();
        });

    });
});