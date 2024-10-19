let ingredients = '';
let offset = 0;
const apiKey = 'c13e725769804969a77e1670b5e70a7c';  // Replace with your Spoonacular API Key
const recipesPerPage = 5;  // Number of recipes to load per request
let queryURL = '';  // Will be updated dynamically
let displayedRecipes = new Set();  // Set to track displayed recipe IDs

$(document).ready(function() {
    // Initial check if limit is exceeded on page load
    if (limitExceed == 1 || noOfSearches >= searchLimit) {
        limitIsExceed(true);
    }    

    $('#recipeSearchForm').on('submit', function(e) {
        e.preventDefault();
        
        ingredients = $('#ingredients').val().trim();  // Get ingredients input
        if (ingredients === "") {
            $('#results').html('<p>Please enter ingredients.</p>');
            return;
        }

        // Reset the offset and queryURL for a new search
        offset = 0;
        displayedRecipes.clear();  // Clear the set of displayed recipes
        queryURL = buildQueryURL();  // Build the query URL dynamically

        $('#results').html('');  // Clear previous results
        
        fetch("/find", {
        "method": "POST",
        "headers": {
            "Content-Type": "application/json; charset=utf-8"
        },
        "body": JSON.stringify({ "search": ingredients, "isSearch": true })
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            noOfSearches = data.searchCount;
            limitExceed = data.limitExceed;
            
            if (data.limitExceed || data.searchCount >= searchLimit) {
                limitIsExceed(true);
                console.log("Limit exceeded");
            } else {
                limitIsExceed(false);
                loadRecipes();
                console.log("Limit not exceeded");
            }

            console.log(data);
        }).catch(error => {
            console.error('Error fetching recipes:', error);
        });

        // Load more button click event
        $('#loadMore').on('click', function() {
            if ($('#recipeSearchForm :input').prop('disabled')) {
                return; // Prevent loading more if the form is disabled
            }
            loadRecipes();
        });
    });

    // Save recipe button click event
    if (userIsPaid) {
        $(document).on('click', '#save-recipe', function() {
            const recipeID = $(this).data('id');
            const recipeTitle = $(this).data('title');
            const recipeImage = $(this).data('image');
    
            console.log('Save recipe ID:', recipeID);
            console.log('Save recipe Title:', recipeTitle);
            console.log('Save recipe Image:', recipeImage);
            
            // Save the recipe to the database
            fetch("/favourites", {
                "method": "POST",
                "headers": {
                    "Content-Type": "application/json; charset=utf-8"
                },
                "body": JSON.stringify({ "recipeID": recipeID, "recipeTitle": recipeTitle, "recipeImage": recipeImage })
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                console.log(data);
                if (data.saved) {
                    $('.message').html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>You successfully saved your recipe.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`
                    );
                    $(this).text('Saved').prop('disabled', true);  // Disable button if successfully saved
                }
            })
            .catch(error => {
                console.error('Error saving recipe:', error);
            });
        });    
    } else {
        $(document).on('click', '#save-recipe', function() {
            $('.message').html(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>You are not a paid user. </strong>To save Favourite Recipes. Please take our subscription.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`
            );
        });
    }

});

// Function to dynamically build the query URL with offset
function buildQueryURL() {
    return `https://api.spoonacular.com/recipes/findByIngredients?ingredients=${ingredients}&number=${recipesPerPage}&offset=${offset}&apiKey=${apiKey}&t=${new Date().getTime()}`;
}

function limitIsExceed(isExceeded) {
    if (isExceeded) {
        $('#results').html(`
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Limit Exceeded!</strong> You have exceeded the limit of ${searchLimit} searches per day.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            `);
            $('#recipeSearchForm :input').prop('disabled', true);
            $('#loadMore').hide();
        } else {
            $('#recipeSearchForm :input').prop('disabled', false);
        }
}

// Function to load recipes
function loadRecipes() {
    console.log("Query: " + queryURL);
    console.log("ingredients: " + ingredients);
    console.log("offset: " + offset);
    console.log("recipesPerPage: " + recipesPerPage);
    //console.log("searchCount: " + searchCount);
    console.log("searchLimit: " + searchLimit);
    console.log("limitExceed: " + limitExceed);
    console.log("noOfSearches: " + noOfSearches);

    queryURL = buildQueryURL();  // Update the query URL with the current offset
    
    console.log("Query URL: " + queryURL);


    // Fetch recipes from Spoonacular API
    $.ajax({
        method: 'GET',
        url: queryURL,
        success: function(response) {
            // Update totalResults from the response headers if Spoonacular provides that, otherwise set a reasonable assumption
            const fetchedRecipes = response.length;

            // Append recipes if available
            if (fetchedRecipes > 0) {
                let newRecipesFound = false;
                response.forEach(function(recipe) {

                    // Check if the recipe is already displayed
                    if (!displayedRecipes.has(recipe.id)) {
                        newRecipesFound = true;  // New unique recipe found
                        displayedRecipes.add(recipe.id);  // Add recipe ID to the set

                        // Append the recipe card
                        $('#results').append(`
                                <div class="special__card">
                                        <img src="${recipe.image}" alt="${recipe.title}" />
                                        <h4>${recipe.title}</h4>
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
                                            <button class="btn"><a href="https://spoonacular.com/recipes/${recipe.title}-${recipe.id}" target="_blank">View Recipe</a></button>
                                            <button class="btn btn-success" id="save-recipe" data-id="${recipe.id}" data-title="${recipe.title}" data-image="${recipe.image}" ">Save</button>
                                        </div>
                                    </div>
                        `);
                    }
                });
                
                // Increase the offset for the next request if new recipes were found
                if (newRecipesFound) {
                    offset += recipesPerPage;
                }

                // If the fetched number of recipes is less than requested, assume no more results
                if (fetchedRecipes < recipesPerPage || !newRecipesFound) {
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