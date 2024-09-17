$(document).ready(function() {
    $('#recipeSearchForm').on('submit', function(e) {
        e.preventDefault();
        const ingredients = $('#ingredients').val();
        const apiKey = 'c13e725769804969a77e1670b5e70a7c';  // Replace with your Spoonacular API Key
        const queryURL = `https://api.spoonacular.com/recipes/findByIngredients?ingredients=${ingredients}&number=5&apiKey=${apiKey}`;

        $.ajax({
            url: queryURL,
            method: 'GET',
            success: function(response) {
                $('#results').empty();
                if (response.length > 0) {
                    response.forEach(function(recipe) {
                        $('#results').append(`
                            <div class="card ms-5 mt-5" style="width: 18rem;">
                                <img src="${recipe.image}" class="card-img-top" alt="${recipe.title}">
                                <div class="card-body">
                                    <h5 class="card-title">${recipe.title}</h5>
                                    <p><a href="https://spoonacular.com/recipes/${recipe.title}-${recipe.id}" target="_blank" class="btn btn-primary">View Recipe</a></p>
                                </div>
                            </div>
                        `);
                    });
                } else {
                    $('#results').append('<p>No recipes found.</p>');
                }
            },
            error: function() {
                $('#results').html('<p>Error retrieving recipes. Please try again.</p>');
            }
        });
    });
});